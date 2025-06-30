#!/bin/bash

# Script de instalación automática para Medussa
# Autor: ChatGPT

echo "==============================================="
echo "       Instalador Automático de Medussa"
echo "==============================================="

# Comprobaciones básicas
if [[ $EUID -ne 0 ]]; then
   echo "Por favor, ejecuta como root: sudo bash install_medussa.sh"
   exit 1
fi

echo "Actualizando sistema..."
apt update && apt upgrade -y

echo "Instalando dependencias..."
apt install -y git apache2 php php-mysql php-xml php-curl php-zip php-gd php-mbstring php-cli unzip mariadb-server

echo "Clonando Medussa..."
if [[ ! -d /var/www/html/medussa ]]; then
    git clone https://github.com/inving9378/medussa-crm.git /var/www/html/medussa
fi

echo "Configurando permisos..."
chown -R www-data:www-data /var/www/html/medussa
chmod -R 755 /var/www/html/medussa

echo "Habilitando Apache y Reiniciando..."
systemctl enable apache2
systemctl restart apache2

echo "==============================================="
echo "  Medussa instalado correctamente."
echo "  Accede desde tu navegador a:"
echo "    http://<TU_IP_SERVIDOR>/medussa"
echo "==============================================="
