```mermaid
flowchart TD
  subgraph "Système de log applicatif"
    User[Utilisateur]
    Dockpulse[Dockpulse<br>(Serveur d'application)]
    Rsyslog[Rsyslog<br>(Serveur de logs)]
  end

  User -->|Effectue une action<br>(ex : connexion)| Dockpulse
  Dockpulse -->|Gère l'action<br>et génère un log| Dockpulse
  Dockpulse -->|Envoie le message de log| Rsyslog
  Rsyslog -->|Traite et stocke le log| Rsyslog
  Rsyslog -->|Accusé de réception| Dockpulse
