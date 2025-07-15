```mermaid
flowchart TD
  subgraph "Système de log applicatif"
    User[Utilisateur]
    Dockpulse["Dockpulse\n(Serveur d'application)"]
    Rsyslog["Rsyslog\n(Serveur de logs)"]
  end

  User -->|Effectue une action\n(ex : connexion)| Dockpulse
  Dockpulse -->|Gère l'action\net génère un log| Dockpulse
  Dockpulse -->|Envoie le message de log| Rsyslog
  Rsyslog -->|Traite et stocke le log| Rsyslog
  Rsyslog -->|Accusé de réception| Dockpulse
