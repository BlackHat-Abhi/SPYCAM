#!/bin/bash

clear='\033[0m'
Red='\033[0;31m'
Green='\033[0;32m'
Yellow='\033[1;33m'
Blue='\033[0;34m'
Purple='\033[0;35m'
Cyan='\033[0;36m'
White='\033[1;97m'
Bold='\033[1m'



function show_banner() {
  echo -e "${Red}${Bold}███████╗███████╗████████╗██╗   ██╗██████╗ ${clear}"
  echo -e "${Green}${Bold}██╔════╝██╔════╝╚══██╔══╝██║   ██║██╔══██╗${clear}"
  echo -e "${Yellow}${Bold}███████╗█████╗     ██║   ██║   ██║██████╔╝${clear}"
  echo -e "${Blue}${Bold}╚════██║██╔══╝     ██║   ██║   ██║██╔═══╝ ${clear}"
  echo -e "${Purple}${Bold}███████║███████╗   ██║   ╚██████╔╝██║     ${clear}"
  echo -e "${Cyan}${Bold}╚══════╝╚══════╝   ╚═╝    ╚═════╝ ╚═╝     ${clear}\n"
  echo -e "${White}${Bold}         SPYCAM Setup Script${clear}"
  echo -e "${White}${Bold}     Created by HackWithDroid Team${clear}\n"
}

clear
show_banner

if [ -n "$PREFIX" ] && [ -e "$PREFIX/bin/pkg" ]; then
  echo -e "${Green}[✔] Detected: Termux${clear}"
  echo -e "${Yellow}[~] Updating packages...${clear}"
  pkg update -y && pkg upgrade -y
  pkg install wget -y
  pkg install openssh -y
  pkg install php -y

else
  echo -e "${Green}[✔] Detected: Linux (Kali, Parrot, Ubuntu etc)${clear}"
  echo -e "${Yellow}[~] Updating packages...${clear}"
  apt update -y
  apt install wget -y
  apt install ssh -y
  apt install php -y
fi

echo -e "\n${Cyan}[~] Setting executable permission for spycam.sh...${clear}"
chmod +x spycam.sh

echo -e "${Green}[✔] Running spycam.sh...${clear}"
./spycam.sh