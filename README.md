# stealth-Server-3.0 Linux+XDk Support+No SQL+No need for Visual Studio(Plug & Play)


Review readme.txt found in client files 

Linux Listener Instructions 


***Ubuntu 18.04***


Step 1 Install dotnet:

Enter below commands in order:


wget https://packages.microsoft.com/config/ubuntu/18.04/packages-microsoft-prod.deb -O packages-microsoft-prod.deb

sudo dpkg -i packages-microsoft-prod.deb



rm packages-microsoft-prod.deb

Then run Command in linux to install 2.1



sudo apt-get update; \
  sudo apt-get install -y apt-transport-https && \
  sudo apt-get update && \
  sudo apt-get install -y aspnetcore-runtime-2.1

Step 2 Run Stealth:


make stealth directory. Enter the command: mkdir stealth

navigate to diretory, enter cd stealth. Then download git repo into directory. Install git if you dont have it. Enter command below:

git clone https://github.com/silent06/stealth-Server-3.0.git

type ls to show folders/files. 

Then Run Dotnet:
1) Navigate to stealth/stealth 3.0/publish folder
2) Run screen first(https://www.interserver.net/tips/kb/using-screen-to-attach-and-detach-console-sessions/)
3) type dotnet stealth.dll
4) Ctrl+A & Ctrl+D to dettach from Screen
5) Done!

check stealth to see if its still running with either ps -aux or netstat -tulpn


**************DONT FORGET TO OPEN STEALTH PORT THROUGH FIREWALL!*******
