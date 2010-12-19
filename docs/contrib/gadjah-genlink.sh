#!/bin/bash

EXPIRE=180
OUTDIR=.
COUNT=0
USERNAME=
PASSWORD=

showhelp () {
cat <<EOF
usage: $0 [-p <path>] [-d <dir> ] [ { -f <file> | -l <list>} ] [-e <num>] [-u <user>] [-w <pass>] [-h]

OPTIONS
One of -f or -l is required. If both supplied -f takes precedence and the other one is ignored.

-h            shows this help screen and exits
-p <string>   uses <string> as path in gadjah to prefix a file (default: "/")
-f <string>   uses <string> as filename in gadjah to generate link for, filename may start with "/"
-l <string>   uses <string> as source to read list of filename in gadjah to generate link for
-d <string>   uses <string> as directory to store output files containing generated link (default: current dir ".")
-e <num>      uses <num> to set expiration days (default: 180)
-u <user>     uses <user> to set username to log in to gadjah (default: empty, or set it in the source code)
-w <pass>     uses <pass> to set password to log in to gadjah (default: empty, or set it in the source code)

EOF
    exit
}

getlink () {
    LFILE="$1"
    BASEFILE=`basename "$1"`
    LINKFILE=$(echo "$BASEFILE" | sed -e 's/\//_/g').txt
    if [ $(echo "$LFILE" | grep "^/") ]; then
        echo ""
    else
        if [ "$TPATH" = "/" ]; then
            LFILE=/$LFILE
        else
            LFILE=$TPATH/$LFILE
        fi
    fi
    #echo "before: $LFILE"
    #LFILE=$(echo "$LFILE" | sed -e 's/ /+/g');
    #echo "after: $LFILE"
    #return
    OUTLINK=$(wget --load-cookies gadjahcookies.txt --post-data "filemail[expires]=$EXPIRE&filemail[linkonly]=on" "http://gadjah.id-gmail.info/index.php?page=filelink&filepath=$LFILE" -O - | perl -nle 'if (m!>(http://gadjah.id-gmail.info/filelink.php\?filecode=[^<]+)<!) { print $1; exit }')
    LINKFILE=$OUTDIR/$LINKFILE
    echo "$BASEFILE (expires in $EXPIRE days)" > "$LINKFILE"
    echo "$OUTLINK" >> "$LINKFILE"
    echo "" >> "$LINKFILE"
    COUNT=$(expr $COUNT + 1)
    echo "GRL is saved to file '$LINKFILE'"
    #/olivejuice/lainlain/Megadeth-Endgame-2009.H3X.rar
}

getlogin () {
wget --keep-session-cookies --save-cookies gadjahcookies.txt --post-data "login_username=$USERNAME&login_password=$PASSWORD" http://gadjah.id-gmail.info/index.php?page=login -O /dev/null
}

countlink () {
    echo "successfully generated $COUNT link(s)"
}

while [ 1 ]; do
    getopts hp:f:l:e:d: switch
    if [ "$?" = "0" ]; then
        case $switch in
            p)
                TPATH=$OPTARG
                ;;
            e)
                EXPIRE=$OPTARG
                ;;
            d)
                OUTDIR=$OPTARG
                ;;
            f)
                TFILE=$OPTARG
                ;;
            u)
                USERNAME=$OPTARG
                ;;
            w)
                PASSWORD=$OPTARG
                ;;
            h)
                showhelp
                ;;
            l)
                TLIST=$OPTARG
        esac
    else
        break
    fi
done

if [ -z "$TPATH" ]; then TPATH=/; fi

if [ -n "$TFILE" ]; then
    getlogin
    getlink "$TFILE"
    countlink
    exit
fi

if [ -z "$TLIST" ]; then
    echo "nothing to do. exiting..."
    exit
fi

getlogin
while read filename; do getlink "$filename"; done < $TLIST
#(while read filename; do echo $filename; done) < $TLIST
countlink

