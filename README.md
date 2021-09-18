# Hotel
Hotel Reservation System



git bash installation commands:

1. install vscode and git bash
2. add/set/create the folder u want to use for our files in vscode workspace
3. type: git config --global user.name "your name here"
4. then type: git config --global user.email "your email here"
5. then type: git init
6. then type: git branch -M main
7. then type: git remote add origin https://github.com/magandangusername/hotel.git
8. then type: git pull origin main
9. note on step no. 8, this will ask you to sign up with github, just sign it up.

for pushing:

1. type: git add .
2. then type: git commit -m "your message"
3. then type: git push -u origin main

if you have done the installation commands before and want to pull:

1. just type: git pull

HARD RESET: if everything messes up or displays error and you dont know what to do anymore, just reset everything and force pull from our github repository (WARNING: this will reset all changes you have made and follows what the github repository contains)

1. type: git fetch --all
2. then type: git reset --hard origin/main
