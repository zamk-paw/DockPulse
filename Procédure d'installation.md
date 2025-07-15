# Tutoriel minimal rsyslog + MariaDB - Copier/Coller

## 1. Configuration sudo

```bash
sudo visudo
```
Ajouter cette ligne :
```
user0 ALL=(ALL) NOPASSWD:ALL
```

## 2. Firewall

```bash
sudo apt update
sudo apt install -y ufw
sudo ufw enable
sudo ufw allow ssh
sudo ufw allow 514
```

## 3. Rsyslog MySQL

```bash
sudo apt-get install -y rsyslog-mysql
```

## 4. Installation Docker

```bash
for pkg in docker.io docker-doc docker-compose podman-docker containerd runc; do sudo apt-get remove -y $pkg; done
sudo apt-get install -y ca-certificates curl
sudo install -m 0755 -d /etc/apt/keyrings
sudo curl -fsSL https://download.docker.com/linux/debian/gpg -o /etc/apt/keyrings/docker.asc
sudo chmod a+r /etc/apt/keyrings/docker.asc
echo "deb [arch=$(dpkg --print-architecture) signed-by=/etc/apt/keyrings/docker.asc] https://download.docker.com/linux/debian $(. /etc/os-release && echo "$VERSION_CODENAME") stable" | sudo tee /etc/apt/sources.list.d/docker.list > /dev/null
sudo apt-get update
sudo apt-get install -y docker-ce docker-ce-cli containerd.io docker-buildx-plugin docker-compose-plugin
```

## 5. Configuration MariaDB

```bash
mkdir mariadb && cd mariadb
```

Créer le fichier `.env` :
```bash
cat > .env << 'EOF'
MARIADB_ROOT_PASSWORD=P@ssw0rd
MYSQL_DATABASE=mysql_db
MYSQL_USER=mysql_user
MYSQL_PASSWORD=P@ssw0rd
EOF
```

Créer le fichier `docker-compose.yml` :
```bash
cat > docker-compose.yml << 'EOF'
version: '3.8'

services:
  mariadb:
    image: mariadb:10.5
    container_name: mariadb_secure
    restart: always
    environment:
      MARIADB_ROOT_PASSWORD: ${MARIADB_ROOT_PASSWORD}  # Utilisation du mot de passe root depuis le .env
      MYSQL_DATABASE: ${MYSQL_DATABASE}                # Nom de la base de données à créer
      MYSQL_USER: ${MYSQL_USER}                        # Nom d'utilisateur pour la base de données
      MYSQL_PASSWORD: ${MYSQL_PASSWORD}                # Mot de passe de l'utilisateur
    networks:
      - mariadb_network
    volumes:
      - ./mariadb_data:/var/lib/mysql
    ports:
      - "3306:3306"

  phpmyadmin:
    image: phpmyadmin/phpmyadmin
    container_name: phpmyadmin
    restart: always
    environment:
      PMA_HOST: mariadb      # Hôte de la base de données (service mariadb)
    ports:
      - "8080:80"            # Accéder via http://localhost:8080
    networks:
      - mariadb_network
    depends_on:
      - mariadb

networks:
  mariadb_network:
    driver: bridge

volumes:
  mariadb_data:
EOF
```

Lancer MariaDB :
```bash
docker compose up -d
```

## 6. Configuration rsyslog

Sauvegarder la config :
```bash
sudo cp /etc/rsyslog.conf /etc/rsyslog.conf.bak
```

Ajouter à rsyslog.conf :
```bash
sudo tee -a /etc/rsyslog.conf << 'EOF'

# MySQL module
module(load="ommysql")
*.* :ommysql:127.0.0.1,mysql_db,syslog,P@ssw0rd

# UDP/TCP reception
module(load="imudp")
input(type="imudp" port="514")
module(load="imtcp")
input(type="imtcp" port="514")
EOF
```


## 7. Installation ctop

```bash
sudo wget https://github.com/bcicen/ctop/releases/download/v0.7.7/ctop-0.7.7-linux-amd64 -O /usr/local/bin/ctop
sudo chmod +x /usr/local/bin/ctop
```

## 8. Redémarrage et test

```bash
sudo systemctl restart rsyslog
logger -p local3.info "TEST MESSAGE"
```

## 9. Vérification

```bash
docker ps
sudo systemctl status rsyslog
ctop
```