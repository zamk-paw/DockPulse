```mermaid
flowchart TD
  subgraph "Système de log applicatif"
    User[Utilisateur]
    Dockpulse["Dockpulse (Serveur d'application)"]
    Rsyslog["Rsyslog (Serveur de logs)"]
  end

  User -->|Action (ex: connexion)| Dockpulse
  Dockpulse -->|Gère l'action et génère un log| Dockpulse
  Dockpulse -->|Envoie message de log| Rsyslog
  Rsyslog -->|Traite et stocke log| Rsyslog
  Rsyslog -->|Accusé de réception| Dockpulse
