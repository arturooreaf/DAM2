#!/bin/bash
# Despliegue de Odoo 18.0 desde código fuente en Ubuntu Server 24.04
# Guía del profe: SGE_despliegue_odoo.pptx (pasos P1-P11, sin Nginx)
# Ejecutar con: sudo bash ~/odoo-setup.sh

# P1 Actualizar el sistema
apt update && apt upgrade -y

# P2 Dependencias del sistema
apt install -y postgresql postgresql-client \
  build-essential python3-dev python3-venv python3-pip \
  libpq-dev libxml2-dev libxslt1-dev \
  libldap2-dev libsasl2-dev \
  libjpeg-dev zlib1g-dev libssl-dev libffi-dev git

# P3 PostgreSQL: servicio + rol
systemctl enable --now postgresql
sudo -u postgres psql -c "CREATE USER odoo WITH CREATEDB PASSWORD 'odoo';"

# P4 Usuario del sistema para Odoo
adduser --system --home=/opt/odoo --group odoo

# P5 Código de Odoo 18.0
git clone https://github.com/odoo/odoo.git --depth 1 --branch 18.0 /opt/odoo/odoo

# P6 venv + dependencias
python3 -m venv /opt/odoo/venv
/opt/odoo/venv/bin/pip install --upgrade pip wheel
/opt/odoo/venv/bin/pip install -r /opt/odoo/odoo/requirements.txt

# P7 Configuración
mkdir -p /etc/odoo
cat > /etc/odoo/odoo.conf <<'EOF'
[options]
admin_passwd = cambia_esta_clave
db_host = localhost
db_port = 5432
db_user = odoo
db_password = odoo
addons_path = /opt/odoo/odoo/addons
http_port = 8069
EOF
chown -R odoo:odoo /opt/odoo /etc/odoo

# P8 Inicializar la BD 'odoo' con el módulo base
sudo -u odoo /opt/odoo/venv/bin/python /opt/odoo/odoo/odoo-bin \
  -c /etc/odoo/odoo.conf -d odoo -i base --stop-after-init

# P11 Servicio systemd
cat > /etc/systemd/system/odoo.service <<'EOF'
[Unit]
After=postgresql.service
[Service]
User=odoo
ExecStart=/opt/odoo/venv/bin/python /opt/odoo/odoo/odoo-bin -c /etc/odoo/odoo.conf
[Install]
WantedBy=multi-user.target
EOF
systemctl daemon-reload
systemctl enable --now odoo
