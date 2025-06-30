#!/usr/bin/env bash
CONFIG_FILE="/etc/medussa/config.env"
if [ ! -f "$CONFIG_FILE" ]; then
  mkdir -p /etc/medussa
  cat > "$CONFIG_FILE" <<EOL
ENABLE_CORE=true
ENABLE_STREAMING=true
ENABLE_SPEEDTEST=true
PUBLIC_IP=
EOL
fi
source "$CONFIG_FILE"
if [ -z "$PUBLIC_IP" ]; then
  read -p "Introduce la IP pública: " PUBLIC_IP
  sed -i "/^PUBLIC_IP=/c\PUBLIC_IP=$PUBLIC_IP" "$CONFIG_FILE"
fi
echo "Instalando Medussa en IP $PUBLIC_IP"
# Aquí invocas scripts...
