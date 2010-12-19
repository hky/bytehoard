<?php

/*
 * ByteHoard 2.1
 * Copyright (c) Andrew Godwin & contributors 2004
 *
 *   Language file
 *   $Id: en.lang.php,v 1.11 2005/07/28 22:38:50 andrewgodwin Exp $
 *
 */
 
#name French
#author Luc Capronnier
#description The french language file.
#description Le fichier en langue française.

$bhlang['module:main'] = "Accueil";
$bhlang['moduledesc:main'] = "Accueil";
$bhlang['module:login'] = "Login";
$bhlang['moduledesc:login'] = "Ouvrir une connexion";
$bhlang['module:logout'] = "Logout";
$bhlang['moduledesc:logout'] = "Fermer une connexion";
$bhlang['module:find'] = "Rechercher un fichier";

$bhlang['title:login'] = "Connexion";
$bhlang['explain:login'] = "Veuillez donner votre nom et votre mot de passe pour vous connectez au système.";
$bhlang['label:username'] = "Nom: ";
$bhlang['label:password'] = "Mot de passe: ";
$bhlang['button:login'] = "Connexion";

$bhlang['title:folders'] = "dossiers";

$bhlang['title:viewing_directory'] = "Contenu du dossier:";
$bhlang['error:not_a_dir'] = "Le chemin fourni n&#39;est pas un dossier.";

$bhlang['error:nothing_in_toolbar'] = "Vous n&#39;avez aucun module dans votre barre d&#39;outils. Il s&#39;agit d&#39;une erreur grave. Veuillez contacter l&#39;administrateur.";

$bhlang['error:not_a_file'] = "Le fichier founi n&#39;est pas du bon type pour cette action.";
$bhlang['error:no_file_specified'] = "Cette action nécessite un fichier, mais vous n&#39;en avez fourni aucun.";
$bhlang['title:viewing_file'] = "Fichiers: ";

$bhlang['module:download'] = "Télécharger";
$bhlang['moduledesc:download'] = "Télécharger ce fichier";

$bhlang['module:delete'] = "Supprimer";
$bhlang['moduledesc:delete'] = "Supprimer ce fichier";

$bhlang['label:_files'] = " Fichiers";

$bhlang['title:error'] = "Erreur";
$bhlang['explain:error_occured'] = "Une erreur est survenue. Celle-ci a été tracée, veuillez cependant avertir l&#39;administrateur.";

$bhlang['error:page_not_exist'] = "Cette page n&#39;existe pas!";
$bhlang['error:file_not_exist'] = "Ce fichier n&#39;existe pas!";
$bhlang['error:directory_no_exist'] = "Ce dossier n&#39;existe pas!";

$bhlang['title:deleting_'] = "Suppression de ";
$bhlang['explain:delete'] = "Etes vous sûr de vouloir supprimer ce fichier?";

$bhlang['button:delete_file'] = "Supprimer ce fichier";
$bhlang['button:cancel'] = "Annuler";
$bhlang['notice:file_deleted'] = "Fichier supprimé.";

$bhlang['error:access_denied'] = "Vous n&#39;êtes pas autorisé à faire cette action.";

$bhlang['title:upload'] = "Téléchargement";

$bhlang['explain:upload'] = "Choisissez les fichiers à télécharger, puis cliquez sur le bouton [Téléchargement] pour commencer.<br /><br />Veuillez noter que pendant le téléchargement, rien ne se passera sur cet écran, cependant la barre de progression de votre navigateur devrait vous tenir informée de l&#39;état d&#39;avancement du téléchargement.";
$bhlang['module:upload'] = "Téléchargement";
$bhlang['moduledesc:upload'] = "Téléchargement de fichiers depuis votre ordinateur.";

$bhlang['button:upload'] = "Téléchargement";
$bhlang['label:uploading_to'] = "Télécharger vers: ";
$bhlang['button:change_folder'] = "Modifier";
$bhlang['title:choose_folder'] = "Choisir un dossier";

$bhlang['error:no_write_permission'] = "Vous n&#39;êtes pas autorisé à écrire dans ce fichier.";

$bhlang['module:url'] = "URL de fichier";
$bhlang['moduledesc:url'] = "Montrer l&#39;URL pour ce fichier.";

$bhlang['explain:the_url_to_that_file_is_'] = "L&#39;URL pour ce fichier est: ";
$bhlang['notice:file_#FILE#_upload_success'] = "Le fichier #FILE# a été téléchargé avec succès.";

$bhlang['notice:logged_out'] = "Vous n&#39;êtes plus connecté.";

$bhlang['log:#USER#_logged_out'] = "Déconnexion pour #USER#";
$bhlang['notice:logged_in_as_#USER#'] = "Connexion pour #USER#. Bienvenue.";
$bhlang['notice:login_failed'] = "Cet identifiant et/ou ce mot de passe est incorrect.";
$bhlang['log:failed_login_#USER#'] = "Erreur de connexion pour #USER#";
$bhlang['log:successful_login_#USER#'] = "Connexion réussie pour #USER#";
$bhlang['log:#USER#_uploaded_#FILE#'] = "Fichier #FILE# téléchargé par #USER#";

$bhlang['title:add_folder'] = "Ajouter un dossier";
$bhlang['module:addfolder'] = "Ajouter un dossier";
$bhlang['moduledesc:addfolder'] = "Permet de créer un dossier";
$bhlang['explain:add_folder'] = "Vous allez créer un nouveau dossier. Choisissez le dossier parent, puis donner le nom de votre nouveau dossier.";
$bhlang['button:add_folder'] = "Créer un dossier";
$bhlang['label:folder_name'] = "Nom du dossier: ";
$bhlang['label:create_in'] = "Dossier parent: ";
$bhlang['log:#USER#_denied_#PAGE#'] = "AAccès interdit à #PAGE# pour #USER#";

$bhlang['log:#USER#_created_#FOLDER#'] = "Dossier #FOLDER# créé par #USER#";
$bhlang['notice:folder_created'] = "Dossier créé.";

$bhlang['notice:file_#FILE#_upload_failure'] = "Le téléchargement du fichier #FILE# a échoué.";
$bhlang['log:#USER#_failed_upload_#FILE#'] = "Echec du téléchargement de #FILE# pour #USER#";

$bhlang['explain:edit'] = "Faites vos modifications pour le fichier ci-dessous, puis cliquez sur le bouton [Enregistrer] pour conserver vos modifications. Attention, si le fichier n&#39;est pas un fichier texte (par exemple un document ou une feuille de calcul), il est probable que cet éditeur ne vous sera d&#39;aucun secours et vous risquez d&#39;endomager votre fichier.";
$bhlang['title:editing_#FILE#'] = "Edition de #FILE#";
$bhlang['button:save'] = "Enregistrer";

$bhlang['module:edit'] = "Edition";
$bhlang['moduledesc:edit'] = "Modifier ce fichier (Editeur texte)";

$bhlang['notice:file_saved'] = "Fichier enregistré.";
$bhlang['log:#USER#_modified_#FILE#'] = "Fichier #FILE# modifié par #USER#";

$bhlang['module:htmledit'] = "Editeur HTML";
$bhlang['moduledesc:htmledit'] = "Modifier ce fichier (Editeur HTML)";

$bhlang['explain:htmledit'] = "Faites vos modifications pour le fichier ci-dessous, puis cliquez sur le bouton [Enregistrer] pour conserver vos modifications.";

$bhlang['label:copy_to'] = "Copier vers: ";
$bhlang['explain:copy'] = "Choisissez le dossier de destination de votre fichier, puis le nouveau nom si nécessaire et cliquez sur le bouton [Copier].";
$bhlang['label:new_name'] = "Nouveau nom: ";
$bhlang['button:copy'] = "Copier";
$bhlang['title:copying_#FILE#'] = "Copier #FILE#";
$bhlang['log:#USER#_copied_#FILE#_to_#DEST#'] = "Fichier #FILE# copier vers #DEST# par #USER#";
$bhlang['notice:file_copied'] = "Fichier copier.";
$bhlang['module:copy'] = "Copier le fichier";
$bhlang['moduledesc:copy'] = "Copier un fichier sous un autre nom et/ou dans un autre dossier";

$bhlang['title:uploading'] = "Téléchargement";
$bhlang['explain:uploading'] = "Le téléchargemenr est en cours. Cela peut prendre un certain temps.<br />Cette fenêtre se fermera de manière automatique dès la fin.";

$bhlang['notice:you_must_be_admin'] = "Vous devez être administrateur pour accéder à cette zone.";
$bhlang['title:__administration'] = " [Administration]";

$bhlang['title:welcome_to_administration'] = "Bienvenue dans l&#39;administration de ByteHoard";
$bhlang['explain:welcome_to_administration'] = "Bienvenue dans la zone d&#39;administration de ByteHoard. Choisissez une action dans les liens au-dessus ou en dessous.";

$bhlang['module:users'] = "Utilisateurs";
$bhlang['moduledesc:users'] = "Administration des utilisateurs et des groupes";

$bhlang['title:user_administration'] = "Administration des utilisateurs";
$bhlang['explain:user_administration'] = "Choisissez un groupe ou [Tous] ci-dessous pour voir les utilisateurs dans ce groupe ou tous les utilisateurs. Pour modifier un utilisateur, cliquez sur son nom.";

$bhlang['label:disk_space_used'] = "Espace disque utilisé";
$bhlang['label:upload_bandwidth_used'] = "Bande passante utilisée";
$bhlang['label:download_bandwidth_used'] = "Download bandwidth used";

$bhlang['title:views'] = "vues";

$bhlang['module:sharing'] = "Partager";
$bhlang['moduledesc:sharing'] = "Partager avec d&#39;autres utilisateurs";

$bhlang['title:sharing_'] = "Partage de ";
$bhlang['explain:sharing'] = "Vous pouvez définir qui d&#39;autres peut voir ce fichier, ainsi que ce qu&#39;ils peuvent faire.";
$bhlang['label:users'] = "Utilisateurs";
$bhlang['label:groups'] = "Groupes";
$bhlang['label:public'] = "Tous le monde";
$bhlang['explain:no_users_sharing_to'] = "Pas de partage avec d&#39;autres utilisateurs.";
$bhlang['explain:no_groups_sharing_to'] = "Pas de partage avec d&#39;autres groupes.";

$bhlang['label:sharing_hidden'] = "Cacher";
$bhlang['explain:sharing_hidden'] = "Ce fichier est caché.";

$bhlang['label:sharing_viewable'] = "Visible";
$bhlang['explain:sharing_viewable'] = "Ce fichier peut être vu et copié mais pas modifié.";

$bhlang['label:sharing_writable'] = "Modifiable";
$bhlang['explain:sharing_writable'] = "Ce fichier peut être vu, copié, modifié ou supprimé.";

$bhlang['label:sharingfolder_hidden'] = "Cacher";
$bhlang['explain:sharingfolder_hidden'] = "Ce dossier est caché.";

$bhlang['label:sharingfolder_viewable'] = "Visible";
$bhlang['explain:sharingfolder_viewable'] = "Ce dossier peut être vu et copié mais pas modifié.";

$bhlang['label:sharingfolder_writable'] = "Modifiable";
$bhlang['explain:sharingfolder_writable'] = "Ce dossier peut être vu, copié, modifié ou supprimé.";

$bhlang['label:change_to'] = "Modifier en: ";

$bhlang['notice:permissions_changed'] = "Permissions modifiées";

$bhlang['label:add_user'] = "Ajouter un utilisateur:";
$bhlang['label:add_group'] = "Ajouter un groupe:";
$bhlang['button:add'] = "Ajouter";

$bhlang['button:edit'] = "Modifier";
$bhlang['button:delete'] = "Supprimer";

$bhlang['column:user_type'] = "Type";
$bhlang['column:used_space'] = "Espace utilisé";
$bhlang['column:bandwidth_30_days'] = "Bande passante (dernier 30 jours)";
$bhlang['column:actions'] = "Actions";
$bhlang['column:username'] = "Nom";

$bhlang['explain:delete_user'] = "Etes vous sur de vouloir supprimer DEFINITIVEMENT cet utilisateur (et ses fichiers)?";
$bhlang['button:delete_user'] = "Supprimer l&#39;utilisateur";
$bhlang['button:delete_user_and_files'] = "Supprimer l&#39;utilisateurs ET ses fichiers";

$bhlang['notice:user_deleted'] = "Utilisateur supprimé.";
$bhlang['notice:user_and_files_deleted'] = "Utilisateur et ses fichiers supprimés.";

$bhlang['title:settings'] = "Configuration";
$bhlang['explain:settings'] = "Ici, vous pouvez modifer les paramètres de configuration de ByteHoard. Choisissez et modifiez les options puis cliquez sur le bouton [Enregistrer].";

$bhlang['label:settings_usetrash'] = "Utilisation de la poubelle?";
$bhlang['explain:settings_usetrash'] = "Si oui, les fichiers ne sont pas supprimés mais déplacer dans la poubelle.";

$bhlang['label:yes'] = "Oui";
$bhlang['label:no'] = "Non";

$bhlang['button:save_settings'] = "Enregistrer";

$bhlang['module:settings'] = "Configuration";
$bhlang['moduledesc:settings'] = "Modification de la configuration";

$bhlang['label:settings_sitename'] = "Nom du site";
$bhlang['explain:settings_sitename'] = "Le nom du site (affiché sur le site et dans les courriels)";

$bhlang['label:settings_limitthumbs'] = "Création de vignettes uniquement pour les petits fichiers?";
$bhlang['explain:settings_limitthumbs'] = "Si vous choisissez [Non], les gros fichiers images risquent de ralentir le système, voir de le bloquer pendant la réalisation des vignettes.";

$bhlang['notice:settings_saved'] = "Configuration enregistrée.";

$bhlang['title:delete_user'] = "Supprimer";
$bhlang['title:edit_user'] = "Modifier";

$bhlang['title:settings'] = "Configuration";

$bhlang['explain:edit_user'] = "Faites les modifications pour cette utilisateur, puis cliquer sur le bouton [Enregistrer] pour mémoriser vos changements.<br />Si vous ne désirez pas modifier le mot de passe, laissez les champs vides.";

$bhlang['subtitle:details'] = "Détails";

$bhlang['title:editing_user_'] = "Modification de l&#39;utilisateur: ";
$bhlang['label:email'] = "Courriel:";
$bhlang['label:full_name'] = "Nom complet:";
$bhlang['label:user_type'] = "Type:";

$bhlang['value:guest'] = "Invité";
$bhlang['value:normal'] = "Normal";
$bhlang['value:admin'] = "Administrateurr";

$bhlang['subtitle:password'] = "Mot de passe";
$bhlang['label:new_password'] = "Nouveau mot de passe:";
$bhlang['label:repeat_new_password'] = "Confirmation du mot de passe:";

$bhlang['button:save_user'] = "Enregistrer";

$bhlang['error:passwords_dont_match'] = "Les deux mots de passe sont différents !";
$bhlang['notice:user_updated'] = "Utilisateur modifié!";

$bhlang['title:signup'] = "Inscription";
$bhlang['explain:signup'] = "Remplissez les champs ci-dessous et cliquez sur [Enregistrement] pour vous inscrire.";

$bhlang['label:repeat_password'] = "Nouvau mot de passe:";
$bhlang['button:signup'] = "Enregistrement";

$bhlang['module:signup'] = "Inscription";
$bhlang['moduledesc:signup'] = "Création d&#39;un compte";

$bhlang['error:username_in_use'] = "Ce nom d&#39;utilisateur n&#39;est pas disponible, veuillez en choisir un autre.";
$bhlang['notice:signup_successful_can_login'] = "Bravo! Vous pouvez maintenant vous connecter avec le nom et le mot de passe qui vous avez choisi.";
$bhlang['log:user_signed_up_'] = "Utilisateur correctement enregistrer avec ";
$bhlang['error:password_empty'] = "Vous n&#39;avez pas saisi de mot de passe!";

$bhlang['notice:file_description_saved'] = "Description du fichier enregistrée!";
$bhlang['title:editing_description_#FILE#'] = "Modification de la description pour #FILE#";
$bhlang['explain:editdesc'] = "Modifier la description du fichier ci-dessous (elle appararaitra dans le liste des fichiers). Laissez le champ vide pour avoir une description automatique.";

$bhlang['button:savedesc'] = "Enregistrer la description";
$bhlang['module:editdesc'] = "Modifier la description";
$bhlang['moduledesc:editdesc'] = "Modifier la desciption de ce fichier";

$bhlang['title:appearance']  = "Style";
$bhlang['explain:appearance'] = "Vous pouvez modifier l&#39;apparence de ByteHoard en choisissant parmi les styles que vous avez installé. Choisissez s&#39;en un en sélectionnant le bouton [Utiliser ce style], le style actuel est identifié par &#39;Style courant&#39; et ne dispose pas du bouton de sélection.<br /><br />Attention, la partie administration a toujours la même apparence et ne dépend pas du style choisi, retourner dans la partie dossier pour voir les modifications.";

$bhlang['label:author'] = "Autheur: ";

$bhlang['module:appearance'] = "Style";
$bhlang['moduledesc:appearance'] = "Modifier le style de l&#39;application";

$bhlang['explain:current_skin'] = "Style courant";

$bhlang['button:use_this_skin'] = "Utiliser ce style";
$bhlang['notice:skin_changed'] = "Style modifier.";

$bhlang['label:settings_signupmoderation'] = "Modération des nouveaux utilisateurs?";
$bhlang['explain:settings_signupmoderation'] = "Si vous choisissez [Oui], un administrateur doit approuver les inscriptions des nouveaux utilisateurs";

$bhlang['error:validation_link_wrong'] = "Désoler, le lien de validation que vous avez utilisé n&#39;est plus valide. Il se peut que la durée de validité soit dépassée. Essayez de vous enregistrer de nouveau.";
$bhlang['log:user_validated_'] = "L&#39;utilisateur a confirmé sont inscription pour ";
$bhlang['log:user_signup_m_pending_'] = "En attente de modération pour ";

$bhlang['notice:moderation_now_pending'] = "Votre demande d&#39;inscription a été validée et transmise à l&#39;administrateur pour approbation. Vous serez informé si votre inscription est acceptée ou rejetée.";
$bhlang['notice:do_email_validation'] = "Un courriel a été envoyé à l&#39;adresse de messagerie que vous avez fourni avec la méthode pour valider votre demande d&#39;inscription.";

$bhlang['emailsubject:registration_validation'] = "[ByteHoard] #SITENAME# confirmation d&#39;inscription";


# Note to translators: Just the stuff inside the double quotes, it's allowed to go over multiple lines.
# Another note: Lines beginning with a hash (#) are ignored. So this line is ignored. And the one above.
$bhlang['email:registration_validation'] = "Votre demande d&#39;inscription est en cours de vérification.

Pour confirmer votre inscription, veuillez visiter le lien ci-dessous avec un navigateur Web:

#LINK#

Si vous ne validier par votre inscription sous 7 jours, elle sera supprimée.";




$bhlang['error:email_error'] = "Un problème est survenu avec le système de messagerie. L&#39;erreur a été enregistrée. Veuillez prévenir l&#39;administrateur du système.";

$bhlang['notice:validation_already_done_pending_approval'] = "Vous avez déjà validé votre inscription. Celle ci est en attente d&#39;approbation par l&#39;administrateur.";

$bhlang['title:registrations_administration'] = "Administration des inscriptions";
$bhlang['module:registrations'] = "Approbation";
$bhlang['moduledesc:registrations'] = "Aprouvez ou rejetez les demandes d&#39;inscription";
$bhlang['explain:registration_administration'] = "Voilà la liste des demandes d&#39;inscription vérifiées en attente d&#39;approbation. Le détail de chaque demande est affiché ainsi que les boutons [Accepter] et [Rejeter]. <br />Attention, il n&#39;y a pas de confirmations des actions.";

$bhlang['notice:registration_moderation_off'] = "Registration moderation is off; all users are currentely being automatically approved after they are verified. To turn it on, go to Settings and change &#39;Moderate user registrations?&#39; to &#39;Yes&#39;.";

$bhlang['button:reject'] = "Rejeter";
$bhlang['button:accept'] = "Accepter";

$bhlang['notice:#USER#_accepted'] = "#USER# accepté.";
$bhlang['notice:#USER#_rejected'] = "#USER# rejeté.";

$bhlang['emailsubject:registration_accepted'] = "[ByteHoard] Inscription acceptée pour le site #SITENAME#";
$bhlang['email:registration_accepted'] = "Votre inscription a été acceptée par l&#39;administrateur.

Nom: #USERNAME#
Mot de passe: Celui que vous avez donné lors de l'inscription.

J'espère que le service vous satisfera.";

$bhlang['emailsubject:registration_rejected'] = "[ByteHoard] Inscription rejetée pour le site #SITENAME#";
$bhlang['email:registration_rejected'] = "Votre inscription a été rejetée par l&#39;administrateur. Votre compte n&#39;est pas créé.";

$bhlang['error:registration_doesnt_exist'] = "Cette demande d&#39;inscription n&#39;existe plus. Il est possible qu&#39;elle a été acceptée ou rejetée par un autre administrateur.";

$bhlang['error:username_too_long'] = "Ce nom d&#39;utilisateur est trop long. La taille mximum est de 255 caractères.";

$bhlang['button:go'] = "Go";
$bhlang['button:request_reset'] = "Demande de réinitialisation";

$bhlang['title:recover_password'] = "Récupération du mot de passe";
$bhlang['explain:recover_password'] = "Utilisez ce formulaire pour récupérer votre mot de passe. Donner votre nom ou votre adresse de messagerie dans le champ approprié puis cliquez sur le bouton [Go]. Vous recevrez un courriel contenant votre nom de connexion et un lien pour effectuer la réinitialisation de votre mot de passe.";

$bhlang['text:or'] = "Ou";

$bhlang['module:passreset'] = "Rénitialisation";
$bhlang['moduledesc:passreset'] = "Récupération de votre mot de passe";

$bhlang['emailsubject:passreset_request'] = "[ByteHoard] Demande de réinitialisation demot de passe pour le site #SITENAME#";
$bhlang['email:passreset_request'] = "Vous ou quelqu&#39;un se faisant passer pour vous à demander que le mot de passe soit réinitialisé pour ce site. Pour effectivement réinitialiser le mot de passe, cliquez sur le lien ci-desous ou ouvrez le lien dans votre navigateur Web:

#LINK#

Si vous n'avez pas demandé cette réinitialisation, ignorez ce courriel. La demande sera supprimée sous 48 heures.";

$bhlang['error:username_doesnt_exist'] = "Cet utilisateur n&#39;existe pas dans notre base de données!";
$bhlang['error:email_doesnt_exist'] = "Cette adresse de messgaerie n&#39;existe pas dans notre base de données!";

$bhlang['emailsubject:passreset_u_request'] = "[ByteHoard] Username and Password Request at #SITENAME#";
$bhlang['email:passreset_u_request'] = "Vous ou quelqu&#39;un se faisant passer pour vous à demander des informations sur votre compte dans ce site #SITENAME#.

Votre nom d'utilisateur est: #USERNAME#

Pour effectivement réinitialiser le mot de passe, cliquez sur le lien ci-desous ou ouvrez le lien dans votre navigateur Web:

#LINK#

Si vous n'avez pas demandé cette réinitialisation, ignorez ce courriel. La demande sera supprimée sous 48 heures.";

$bhlang['notice:passreset_request_sent'] = "Un courriel contenant des informations sur la procédure a été envoyé à votre adresse de messagerie.";

$bhlang['error:passreset_link_invalid'] = "Ce lien est invalide. Soit il n&#39;est plus valide, soit il y a une erreur.";

$bhlang['emailsubject:passreset_new_password'] = "[ByteHoard] Votre nouveau mot de passe pour le site #SITENAME#";
$bhlang['email:passreset_new_password'] = "Votre nouveau mot de passe pour le site est :

#PASSWORD#

Il s'agit d'un mot de passe calculer que vous pouvez modifier dans la partie options du site.";

$bhlang['notice:passreset_new_password_sent'] = "Votre nouveau mot de passe a été envoyé par messagerie à votre adresse.";

$bhlang['error:username_invalid'] = "Ce nom d&#39;utilisateur est invalide.";

$bhlang['error:systemwrong'] = "Erreur fatale: La configuration de votre système empêche cette fonctione de fonctionner correctement.";

$bhlang['title:options'] = "Options";
$bhlang['module:options'] = "Options";
$bhlang['moduledesc:options'] = "Modifier vos options";
$bhlang['explain:options'] = "Vous pouvez modifier des informations sur votre compte ainsi que votre mot de passe.";
$bhlang['title:change_password'] = "Modification du mot de passe";
$bhlang['title:interface_options'] = "Option d&#39;affichage";
$bhlang['title:profile'] = "Profile";

$bhlang['label:old_password'] = "Ancien mot de passe: ";
$bhlang['button:change_password'] = "Modification du mot de passe";
$bhlang['error:old_password_invalid'] = "Votre ancien mot de passe est incorrect! Veiullez le saisir de nouveau.";
$bhlang['notice:password_changed'] = "Le mot de passe a été modifié!";

$bhlang['error:unknown'] = "Une erreur inconnue s&#39;est produite. Veuillez la signalée à l&#39;administrateur.";
$bhlang['warning:blank_password'] = "Vous n&#39;avez pas saisie de mot de passe! Ce n&#39;est pas une bonne solution en terme de sécurité.";

# These are all options! We're not going to collect all this inforation about every user.
# The administrator will be able to choose which ones to allow.
$bhlang['profile:email'] = "Courriel";
$bhlang['profile:fullname'] = "Nom complet";
$bhlang['profile:website'] = "Site Web";
$bhlang['profile:telephone'] = "Numéro de téléphone";
$bhlang['profile:fax'] = "Numéro de fax";
$bhlang['profile:jabber'] = "Jabber ID";
$bhlang['profile:icq'] = "ICQ#";
$bhlang['profile:msn'] = "MSN ID";
$bhlang['profile:aim'] = "AIM ID";
$bhlang['profile:yahoo'] = "Yahoo! ID";
$bhlang['profile:nickname'] = "Surnom";
$bhlang['profile:position'] = "Position";
$bhlang['profile:location'] = "Lieu";
$bhlang['profile:gender'] = "Genre";
$bhlang['profile:address'] = "Adresse";
$bhlang['profile:postcode'] = "Numéro";
$bhlang['profile:zipcode'] = "Code postal";
$bhlang['profile:nationality'] = "Nationality";
$bhlang['profile:latitude'] = "Latitude";
$bhlang['profile:longitude'] = "Longitude";
$bhlang['profile:occupation'] = "Occupation";
$bhlang['profile:status'] = "Status";

$bhlang['button:save_profile'] = "Enregistrer";
$bhlang['notice:profile_saved'] = "Profile saved.";

$bhlang['error:cannot_determine_update_server'] = "LE serveur a mettre à jour ne peut pas être trouvé. Il est possible que le site soit indisponible. Veuillez essayer ultérieurement.";
$bhlang['error:cannot_download_package'] = "The package file cannot be downloaded from the remote server.";
$bhlang['error:system_setup_wrong'] = "Your system is unable to download the files required. You must do this manually.";
$bhlang['error:cannot_write_to_package'] = "Cannot write to the package file. Check the ByteHoard directory's permissions are correctly set.";

$bhlang['title:folder_files'] = "Fichiers";
$bhlang['title:folder_actions'] = "Actions sur les dossiers";
$bhlang['module:deletefolder'] = "Suppression";
$bhlang['moduledesc:deletefolder'] = "Supprimer ce dossier et ses fichiers";
$bhlang['module:copyfolder'] = "Copier le dossier";
$bhlang['moduledesc:copyfolder'] = "Copier ce dossier dans un autre dossier";
$bhlang['module:sharingfolder'] = "Partager";
$bhlang['moduledesc:sharingfolder'] = "Partager ce dossier avec d&#39;autres utilisateurs";
$bhlang['notice:folder_deleted'] = "Dossier supprimé";

$bhlang['error:cannot_delete_that'] = "Vous ne pouvez pas supprimer ce dossier ou ce fichier.";

$bhlang['button:delete_folder'] = "Suppression de dossier";
$bhlang['explain:deletefolder'] = "Voulez vous vraiment supprimer ce dossier et tout son contenu?";

$bhlang['label:settings_fromemail'] = "Adresse de l&#39;émettteur des courriels: ";
$bhlang['explain:settings_fromemail'] = "L&#39;adresse qui sera utilisée comme émetteur pour tous les courriels émis par le serveur.";
$bhlang['label:settings_imageprog'] = "Programme de gestion des images: ";
$bhlang['explain:settings_imageprog'] = "Doit impérativement être &#39;imagemagick&#39; ou &#39;gd&#39;. Laissez vide pour ne pas générer de vignettes.";
$bhlang['label:settings_syspath_convert'] = "Chemin pour &#39;convert&#39;: ";

# Translators; Leave $"."PATH as it is.
$bhlang['explain:settings_syspath_convert'] = "Nécessaire uniquement si vous avez choisi &#39;imagemagick&#39; comme programme de gestion d&#39;image.<br />Vous pouvez utiliser &#39;convert&#39; si il se trouve dans le PATH de votre sytème $"."PATH.";

$bhlang['label:settings_fileroot'] = "Répertoire virtuel de base: ";
$bhlang['explain:settings_fileroot'] = "Ce répertoire est le répertoire de base à partir duquel ByteHoard stocke les fichiers.<br /><b>NE PAS MODIFIER</b> sauf si vous savez ce que vous faites.<br />Le chemin NE DOIT PAS se terminer par un slash.";

$bhlang['error:no_gd'] = "Erreur fatale. GD n&#39;est pas installé, cependant GD est sélectionné pour la génération des vignettes.";

$bhlang['explain:sharingfolder'] = "Vous pouvez définir qui peut consulter ce dossier, ainsi que les actions autorisées.<br />Attention, les modifications faites seront reportées sur TOUS les fichiers de ce dossier.<br />Pour cette raison, il est déconseillé de partager son répertoire principal.";

$bhlang['label:sharingfolder_owner'] = "Propriétaire";
$bhlang['explain:sharingfolder_owner'] = "Control total sur le dossier.";
$bhlang['label:sharing_owner'] = "Propriétaire";
$bhlang['explain:sharing_owner'] = "Controle total sur le fichier.";

$bhlang['error:permissions_self'] = "Vous ne pouvez pas modifer vos propres permissions.";
$bhlang['notice:permissions_changed'] = "Permissions modifiées.";
$bhlang['notice:permissions_group_added'] = "Groupe ajouté.";
$bhlang['notice:permissions_user_added'] = "Utilisateur ajouté.";
$bhlang['notice:permissions_group_deleted'] = "Groupe supprimé.";
$bhlang['notice:permissions_user_deleted'] = "Utiliateur supprimé.";

$bhlang['label:delete_user'] = "Supprimer l&#39;utilisateur: ";
$bhlang['label:delete_group'] = "Supprimer le groupe: ";

$bhlang['button:return'] = "Retour";

$bhlang['module:returntofolder'] = "Retour au dossier";
$bhlang['moduledesc:returntofolder'] = "Voir le dossier dans lequel se trouve ce fichier";

$bhlang['notice:folder_copied'] = "Dossier copié.";

$bhlang['module:filelink'] = "Liens";
$bhlang['moduledesc:filelink'] = "Créer un lien temporaire sur un fichier";
$bhlang['error:no_filepath'] = "Erreur fatale: Aucun chemin de fourni.";

$bhlang['title:filemail'] = "Liens";
$bhlang['explain:filemail'] = "Cette fonction autorise la création d&#39;un lien temporaire sur un fichier que vous pouvez recopier ou envoyer par courriel directement dans cette page. Le lien aura une durée temporaire de validité. <br /><br />Remplissez les champs ci-dessous avec les informations voulues (destinataires, sujet, message). Le lien sera ajouté automatiquement à la fin du message. Pour séparer des destinataires multiples, utilisez la virgule.";

$bhlang['label:subject'] = "Sujet: ";
$bhlang['label:message'] = "Message: ";

$bhlang['error:no_emailaddr'] = "Vous n&#39;avez pas fourni d&#39;adresse de messagerie.";
$bhlang['error:no_emailsubj'] = "Vous n&#39;avez pas fourni de sujet.";
$bhlang['error:invalid_email_#EMAIL#'] = "Cette adresse de messagerie &#39;#EMAIL#&#39; est invalide.";

$bhlang['notice:email_sent'] = "Le courriel a été envoyé.";
$bhlang['notice:email_sent_to_#EMAIL#'] = "Le courriel a été envoyé à #EMAIL#.";

$bhlang['text:days'] = " jours";
$bhlang['label:expires_in'] = "Expire dans: ";

$bhlang['text:max_#NUM#_days'] = "(maximum #NUM# jours)";

$bhlang['error:expires_invalid'] = "Cette durée est invalide. Vous devez fournir un chiffre positif.";
$bhlang['error:expires_too_much'] = "Cette durée est supérieure à la durée maximum autorisée.";

$bhlang['label:settings_maxexpires'] = "Durée maximum pour les liens (FileMail) en jours: ";
$bhlang['explain:settings_maxexpires'] = "La durée maximum qui peut être fixée lors de la création d&#39;un lien (FileMail) sur un fichier.";

$bhlang['error:no_filecode'] = "Vous n&#39;avez pas fourni de liens avec un code de fichier.";
$bhlang['error:filecode_invalid'] = "Le lien que vous avez fourni est soit invalide, soit expiré.";

$bhlang['title:filelinks'] = "Administration des liens (FileMail)";
$bhlang['module:filelinks'] = "Liens";
$bhlang['moduledesc:filelinks'] = "Administration des liens (FileMail)";
$bhlang['explain:filelinks'] = "Cette page présente les liens (FileMail) actifs.<br />Ils sont classés par utilisateur. Pour chaque lien, il est fourni l&#39;adresse de messagerie, le nom du fichier, la date d&#39;expiration du lien.<br />Vous pouvez visualiser ce lien en cliquant sur [Lien] ou le supprimer en cliquant sur [Suppression].";

$bhlang['column:expires_in'] = "Expire dans";
$bhlang['column:email'] = "Adresse de messagerie";
$bhlang['column:file'] = "Fichier";

$bhlang['button:link'] = "Lien";

$bhlang['notice:filelink_deleted'] = "Le lien est supprimé.";

$bhlang['log:filelink_denied'] = "Accès interdit à #FILELINK#";
$bhlang['log:filelink_accessed'] = "#FILEPATH# est utilisé par le lien [#FILELINK#].";

$bhlang['label:settings_authmodule'] = "Module d&#39;authentication: ";
$bhlang['explain:settings_authmodule'] = "Le nom du module utilisé pour assurer l&#39;authentification des utilisateurs. Laisser la valeur par défaut &#39;bytehoard.inc.php&#39; si vous n&#39;avez pas besoin d&#39;un autre système authentification.";

$bhlang['button:send'] = "Envoyer";
$bhlang['button:back'] = "Retour";


$bhlang['label:settings_baseuri'] = "ByteHoard Web URL (optionel): ";
$bhlang['explain:settings_baseuri'] = "L&#39;URL d&#39;accès à l&#39;application ByteHoard (mettre un slash à la fin). Ce paramètre est optionel, si vous le laissez vide le système calculera une valeur automatiquement.";

$bhlang['title:overwriting_'] = "Ecraser ";
$bhlang['explain:overwrite'] = "Le fichier téléchargé possède le même nom qu&#39;un fichier existant. Que voulez vous faire ?";

$bhlang['label:linkonly'] = "Créer seulement un lien (ne pas envoyer de courriel): ";

$bhlang['text:link__expire_in_#EXPIRE#'] = "Lien (Expirera dans #EXPIRE# jours): ";

$bhlang['label:html'] = "HTML: ";
$bhlang['label:bbcode'] = "BBcode: ";
$bhlang['title:image_tags'] = "Image Tags";

$bhlang['error:email_empty'] = "Vous n&#39;avez pas saisie d&#39;adresse de messagerie.";

$bhlang['email:filemail_footer'] = "---------------------------------------------
Le fichier sera disponible au téléchargement jusqu'au #DATE#

Fichier: #FILENAME#, #FILESIZE# (MD5: #MD5#)
#LINK#

Vous avez reçu un liens sur un fichier dans ce courrier envoyer par le site #SYSTEMNAME#. 
Pour télécharger le fichier, veuillez cliquer sur le lien.";

$bhlang['label:downloadnotice'] = "Envoie d&#39;un courrier de notification de téléchargement: ";

$bhlang['emailsubject:filemail_link_accessed'] = "[ByteHoard] Notification de lien pour le téléchargement (#FILENAME#)";

$bhlang['email:filemail_link_accessed'] = "Notification automatique.

L'un de vos lien (FileMail) a été utilisé. Vous aviez demandé à en être notifié lors de l'accès à ce fichier quand vous avez créé le lien.

Le fichier (#FILEPATH#) a été consulté à #TIME#, depuis l'adresse IP #IP#. Le lien a été envoyé à l'adresse de messagerie #EMAIL#.

Note: Ce lien expire le #EXPIRES#.";




$bhlang['install:title:bytehoard_installation'] = "ByteHoard Installation";

$bhlang['install:title:page_not_found'] = "Page Not Found";
$bhlang['install:error:page_not_found'] = "That page does not exist!";
$bhlang['install:title:menu'] = "Menu";
$bhlang['install:menu:install'] = "Install ByteHoard";
$bhlang['install:menu:upgrade'] = "Upgrade ByteHoard";
$bhlang['install:menu:documentation'] = "Documentation";
$bhlang['install:menu:systeminfo'] = "System Information";

$bhlang['install:text:install_intro'] = "Welcome to ByteHoard ".$bhconfig['version'].".<br /><br />The next few pages will take you through the installation process. The setup is relatively easy; the system will try to guide you through it as much as possible. You will need to have the details of your database login handy, as well as ensuring your system meets the minumum requirements for installing ByteHoard.<br /><br />By proceeding with the installation, you agree to the license of this software - the GNU GPL v2 (a copy of which you can find included with the archive under the file LICENSE, or at <a href='http://www.gnu.org/copyleft/gpl.html'>http://www.gnu.org/copyleft/gpl.html</a>.<br><br>For support, updates, extras and news on development check out our website at <a href='http://bytehoard.org'>bytehoard.org</a>";

$bhlang['install:title:introduction'] = "Introduction";
$bhlang['install:title:systemchecks'] = "System Checks";
$bhlang['install:text:checking_system'] = "Checking system...";
$bhlang['install:label:php'] = "PHP";
$bhlang['install:label:extensions'] = "Extensions";
$bhlang['install:label:external_progs'] = "External Programs";
$bhlang['install:label:filesystem'] = "Filesystem";
$bhlang['install:check:php'] = "PHP version: ";
$bhlang['install:check:safe_mode'] = "Safe_mode is off: ";
$bhlang['install:check:pcre'] = "PCRE: ";
$bhlang['install:check:gd'] = "GD: ";
$bhlang['install:check:imagemagick'] = "ImageMagick: ";

$bhlang['install:check:php5'] = "PHP5 (not fully tested)";
$bhlang['install:check:failed'] = "Failed";
$bhlang['install:check:failedoption'] = "Failed (optional)";
$bhlang['install:check:ok'] = "OK";

$bhlang['install:check:failedphp'] = "Failed (PHP 4.2 or newer required)";
$bhlang['install:check:failedsafemode'] = "Failed (safe_mode is ON)";
$bhlang['install:check:failedperm'] = "Failed (file not writable, check permissions)";

$bhlang['install:check:config.inc.php'] = "config.inc.php is writable: ";
$bhlang['install:check:cache'] = "cache/ is writable: ";

$bhlang['install:text:checksok'] = "All checks seem to have passed. Good.";
$bhlang['install:text:checkswarnings'] = "You seem to have a few warnings, but nothing serious. You may continue, or you can try to install the missing components. If you need help with this, please feel free to drop by the ByteHoard website (bytehoard.org) and ask us questions.";
$bhlang['install:text:checksfatals'] = "One or more essential tests failed. Please sort these out before you continue. If you need help with any of there problems, then please drop by bytehoard.org and we'll be happy to help you.";
$bhlang['install:text:thumbnails_disabled'] = "Note: Thumbnails will be disabled. Please install GD or ImageMagick to use thumbnails.";
$bhlang['button:next'] = "Next";

$bhlang['install:title:choose_database'] = "Choose Database";
$bhlang['install:title:configure_database'] = "Configure Database";

$bhlang['install:title:system_information'] = "System Information";

$bhlang['install:configdb:intro'] = "You must now provide your database connection details. If you are unsure about what they are, talk to your system administrator, or if that fails, or you don't have one, try asking us for help.";
$bhlang['install:configdb:nont_needed'] = "This database module has no configuration. You may proceed to the next step.";
$bhlang['install:title:save_database_configuration'] = "Saving Database Configuration...";
$bhlang['install:writeconfig:saved'] = "Database configuration successfully saved.";
$bhlang['install:writeconfig:not_saved'] = "There was an error while saving the database configuration. Please check the permissions on the ByteHoard directory.";
$bhlang['install:title:init_database'] = "Initialising Database";

$bhlang['install:title:test_database_configuration'] = "Testing Database Configuration...";
$bhlang['install:testdb:ok'] = "Configuration seems to be valid.";
$bhlang['install:testdb:failed'] = "Cannot connect to the database! Error is below.";
$bhlang['error:error_creating_table'] = "Error creating table: ";
$bhlang['install:initdb:database_initialised'] = "Database Initialised.";

$bhlang['install:title:set_paths'] = "Set Paths";

$bhlang['install:paths:intro'] = "You now need to set the paths for ByteHoard. You will need to set both the URL of the system and the directory where users' files will be stored.<br><br>The installer will have tried to guess your URL; nevertheless, check it, as sometimes extra parts appear or slashes are missing. The given URL should have a http:// or https:// prefix, and a trailing slash (/) at the end.<br><br>The 'filestorage' directory defaults to the subdirectory in the ByteHoard directory called 'filestorage'; this is not totally secure, and if you can you should create a directory outside of the web directories, give it the appropriate permissions, and provide that as a path instead. <br>Please note that a relative path will be interpreted from the ByteHoard directory.";

$bhlang['install:paths:system_url'] = "System URL: ";
$bhlang['install:paths:file_storage_directory'] = "File storage directory: ";

$bhlang['value:enabled'] = "Non";
$bhlang['value:disabled'] = "Oui (L&#39;utilisateur ne peut pas se connecter)";

$bhlang['label:disabled'] = "Désactivation?: ";

$bhlang['install:title:save_paths'] = "Saving Paths...";

$bhlang['install:savepaths:message'] = "Paths saved.";

$bhlang['install:savepaths:error_baseuri'] = "That is an invalid system URL. Please ensure that the URL includes http:// or https:// and that it ends in a trailing slash.";
$bhlang['install:savepaths:error_fileroot'] = "That is an invalid directory path.";

$bhlang['install:title:create_administrator'] = "Create Administrator";

$bhlang['notice:login_failed_disabled'] = "Connexion refusée : Votre compte est désactivé.";

$bhlang['log:failed_login_disabled_#USER#'] = "#USER# n&#39;est pas autorisé à se connecter (compte désactivé)";

$bhlang['title:add_user'] = "Création d&#39;utilisateur";
$bhlang['explain:add_user'] = "Utilisez ce formulaire pour créer un nouvel utilisateur. Vous devez fournir un nom, un mot de passe et une adresse de messagerie. Les autres champs sont optionnels";
$bhlang['button:add_user'] = "Création";
$bhlang['notice:user_added'] = "Utilisateur créé.";
$bhlang['label:homedir'] = "Dossier de base : ";
$bhlang['value:normal_homedir'] = "Sous dossier sous / (par défaut)";
$bhlang['value:root_homedir'] = "/ (pas de dossier de base)";
$bhlang['label:groups'] = "Groupe initial (si plusieurs, les séparer par une virgule): ";
$bhlang['module:adduser'] = "Création d&#39;utilisateur";
$bhlang['moduledesc:adduser'] = "Création d&#39;utlisateur dans le système.";

$bhlang['install:createadmin:explain'] = "An administrator user has been created. Please keep these details safe; you can change the password or add a new administrator user once you have logged in.";


$bhlang['install:finish:explain'] = "Installation is now complete. You may log in using the administrator username and password shown above.<br><br><b>Please note: You MUST completely delete the install/ directory before you start using ByteHoard. Anyone who has access to this directory can reset the system with a new administration username and password, which they will know, as well as possibly being able to access the database of both ByteHoard and other software on this machine. Leaving it is a massive security risk. Should you wish to re-install or upgrade, you can simply extract just the install/ directory from the archive.</b><br><br>We recommend that you log in to the administration area first and change the settings to suit your system. The URLs of the main area and the administration area are shown below.";
$bhlang['install:finish:label:url'] = "System URL: ";
$bhlang['install:finish:label:adminurl'] = "Administration URL: ";

$bhlang['error:signup_disabled'] = "L&#39;inscription a été désactivé.";
$bhlang['label:settings_signupdisabled'] = "Ne pas autoriser l&#39;inscription?: ";
$bhlang['explain:settings_signupdisabled'] = "Si vous cochez cette option, l&#39;inscription ne sera pas possible par les utilisateurs.";

$bhlang['install:title:complete'] = "Complete";

$bhlang['install:title:bytehoard_upgrade'] = "ByteHoard Upgrade";

$bhlang['install:update:intro'] = "Welcome to the ByteHoard Updater. This program will upgrade your old ByteHoard installation to this version.<br><br>Note that to upgrade you should have moved or deleted the contents of the old ByteHoard directory apart from the <i>config.inc.php</i> file and the <i>filestorage/</i> or <i>userfiles/</i> directory, and then you should have extracted the new ByteHoard files into that same directory (you may have to move them from the folder the extraction generates, probably called something like <i>bytehoard-".str_replace(" ","-",strtolower($bhconfig['version']))."/</i>.<br><br>Please make a backup of your old ByteHoard files and database before performing this operation; you should do this before installing any new software, but in this case the upgrade operations may not work successfully, due to the large variety of systems they are designed to upgrade.";

$bhlang['install:title:choose_old_version'] = "Choose Old Version";

$bhlang['install:upgrade:choose_text'] = "Please select the version you are upgrading from. Note that selecting the wrong version will have... interesting results.";

$bhlang['button:upgrade'] = "Upgrade";

$bhlang['install:title:upgrading'] = "Upgrading...";

$bhlang['install:error:no_upgradefrom'] = "You have not selected a version to upgrade from!";
$bhlang['install:error:invalid_upgradefrom'] = "You have somehow managed to provide a wrong version to upgrade from. Try again.";

$bhlang['install:upgrade:complete'] = "Upgrade complete. You can now use the system; see below for upgrade-specific notes.";

$bhlang['install:upgrade:notes'] = "Notes:";

$bhlang['install:upgrade:specific:2.0.x_to_2.1.g'] = "ByteHoard 2.1 is quite a big step up from 2.0. There are many new features and some have disappeared since 2.0. Things you should note include: <ul><li>The administration area is now accessed by going to the ByteHoard URL followed by /administrator/ (Note that an 'administration centre' link should appear anyway).</li>
<li>All your users have been transferred over, and your old administrators remain as administrators. However, any pending registrations have been removed.</li>
<li>All your old FileMail links will continue to work until they expire.</li>
<li>All your old groups and their users have been carried over.</li>
<li>All FileMails now come from the users' email addresses by default.</li>
<li>If email functions were turned off they have been turned back on.</li>
<li>User space quotas have been removed, since this is not yet implemented.</li></ul><br><br>We hope you enjoy ByteHoard 2.1.";

$bhlang['label:remind_in'] = "Rappel: ";
$bhlang['text:days_before_expiry'] = "Nombre de jours avant la fin (0 = Pas de rappel)";

$bhlang['title:group_administration'] = "Administration des groupes";

$bhlang['explain:group_administration'] = "Cette écran vous permet d&#39;administrer les groupes d&#39;utilisateurs. <br /><br />Tous les groupes existants sont présentés ci-dessous, avec les utilisateurs qui en font parti. <br />Pour supprimer un utilisateur d&#39;un groupe, cliquer sur le bouton [Supprimer]. <br />Pour ajouter un utilisateur à un groupe, donner le nom de l&#39;utilisateur et le nom du groupe puis cliquez sur le bouton [Ajouter]. <br /><br />Attention, les groupes ne sont que des ensembles d&#39;utilisateurs, pour créer un nouveau groupe, il suffit de mettre une personne dans le groupe à créer.<br />Le nom de groupe &#39;Tous&#39; est réservé par le système, tous les noms de groupe sont convertis en minuscule.";

$bhlang['button:remove'] = "Supprimer";
$bhlang['label:group'] = "Groupe: ";
$bhlang['button:add_to_group'] = "Ajouter";

$bhlang['module:admin'] = "Administration";
$bhlang['moduledesc:admin'] = "Zone d&#39;administration de ByteHoard.";

$bhlang['module:return'] = "Dossiers";
$bhlang['moduledesc:return'] = "Reviens à la partie gestion des dossiers de ByteHoard.";

$bhlang['module:groups'] = "Groupes";
$bhlang['moduledesc:groups'] = "Gestion des groupes d&#39;utilisateurs.";

$bhlang['text:no_groups'] = "Il n&#39;y a pas de groupe créer.";

$bhlang['notice:user_added_to_group'] = "L&#39;utilisateur &#39;#USERNAME#&#39; a été ajouté au groupe &#39;#GROUP#&#39;.";
$bhlang['notice:user_removed_from_group'] = "L&#39;utilisateur &#39;#USERNAME#&#39; a été supprimé du groupe &#39;#GROUP#&#39;.";
$bhlang['error:user_is_in_group'] = "L&#39;utilisateur &#39;#USERNAME#&#39; est déjà dans le groupe &#39;#GROUP#&#39;.";
$bhlang['error:user_does_not_exist'] = "L&#39;utilisateur &#39;#USERNAME#&#39; n&#39;existe pas!";

$bhlang['title:file_download'] = "Fichier a télécharger";
$bhlang['label:filesize'] = "Taille: ";
$bhlang['label:filename'] = "Nom: ";
$bhlang['label:from'] = "De: ";
$bhlang['label:md5'] = "MD5 Hash: ";
$bhlang['button:download_file'] = "Téchargement de #FILENAME#";
$bhlang['error:md5_file_too_large'] = "(Fichier trop volumineux; MD5 n&#39;est pas calculée)";

$bhlang['explain:filelink_download'] = "Le début du téléchargement du fichier va commencer dans quelques secondes. Si le lancement automatique ne se fait pas, cliquez sur lien. Si votre navigateur ouvre le document au lieu de le sauvegarder, effectuer un clic droit sur le lien et utilisez l&#39;option de sauvegarde &#39;Enregistrer sous&#39; ou &#39;Enregister la cible du lien sous&#39; pour enregistrer le fichier.";

$bhlang['error:quota_exceeded'] = "Cette action entraine une dépassement de votre quota de #QUOTA#.";

$bhlang['label:settings_lang'] = "Fichier de langue: ";
$bhlang['explain:settings_lang'] = "Le fichier de langue a utilisé par l&#39;application.";

$bhlang['label:quota'] = "Quota: ";

$bhlang['label:_mb'] = "MB";

$bhlang['explain:edit_quota'] = "(Note: 0 ou vide signifie pas de quota)";
$bhlang['error:quota_not_a_number'] = "Le quota choisi n&#39;est pas un nombre valide!";

$bhlang['title:quota'] = "Quota";
$bhlang['explain:you_have_used_some_quota'] = "Vous utilisé #QUOTAUSED# des #QUOTA# de votre quota.";

$bhlang['title:types_administration'] = "Type d&#39;utilisateur/Administration des quotas";
$bhlang['error:missed_something'] = "Vous n&#39;avez pas saisi un champ obligatoire.";
$bhlang['explain:types_administration'] = "Utulisé cet écran pour créer et surpprimer des types d&#39;utilisateur (quotas/pricing plans).";
$bhlang['column:type_name'] = "Nom du type";
$bhlang['column:type_size'] = "Nom du quota";



