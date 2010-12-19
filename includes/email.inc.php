<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2003-2004
 *
 *   Email Functions File
 *   $Id: email.inc.php,v 1.1 2005/06/17 18:52:00 andrewgodwin Exp $
 *
 */

# Test for include status
if (IN_BH != 1) { header("Location: ../index.php"); die(); }
 
class bhemail {
	var $from;
	var $xmailer;
	var $message;
	var $subject;
	var $to;
	var $sig;
	var $messageprepared;
	
	function bhemail($to = "") {
		global $bhconfig;
		$this->to = $to;
		if (!empty($bhconfig['fromemail'])) { $this->from = $bhconfig['fromemail']; } else { $this->from = "root@".$_SERVER['HTTP_HOST']; }
		if (!empty($bhconfig['emailsig'])) { $this->sig = $bhconfig['emailsig']; }
		$this->xmailer = "ByteHoard/".$bhconfig['version'];
	}
	
	function preparemessage() {
		if ($this->messageprepared == 0) {
			$this->message = str_replace("\n\r", "\n", $this->message);
			$this->message = str_replace("\n.", "\n..", $this->message);
			$messagearray = explode("\n", $this->message);
			foreach ($messagearray as $key=>$messageline) {
				$messagearray[$key] = wordwrap($messageline, 70, "\n");
			}
			$this->message = implode("\n", $messagearray);
			$this->message .= "\n".$this->sig;
			$this->messageprepared = 1;
		}
	}
	
	function send() {
		$this->preparemessage();
		$headers = "From: ".$this->from."\r\n"."X-Mailer:".$this->xmailer;
		if (!empty($this->ctype)) { "\r\n"."Content-type:".$this->ctype; }
		if (!empty($this->mimev)) { "\r\n"."Mime-Version:".$this->mimev; }
		return $result = mail($this->to, $this->subject, $this->message, $headers);
	}
	
	function sendtouser($username) {
		$userinforows = select_bhdb("userinfo", array("username"=>$username, "itemname"=>"email"), 1);
		if (empty($userinforows)) { return false; }
		$this->to = $userinforows[0]['itemcontent'];
		return $this->send();
	}
	
	function sendtotype($usertype) {
		$userrows = select_bhdb("users", array("type"=>$usertype), "");
		if (empty($userrows)) { return false; }
		$fails = 0;
		foreach ($userrows as $userrow) {
			$result = $this->sendtouser($userrow['username']);
			if ($result == false) { $fails++; }
		}
		return $fails;
	}
}