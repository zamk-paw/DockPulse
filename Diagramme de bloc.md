```mermaid
flowchart TD
  subgraph "Système de log applicatif"
    User[Utilisateur]
    Dockpulse["Dockpulse - Serveur d'application"]
    Rsyslog["Rsyslog - Serveur de logs"]
  end

  User --> Action1[Effectue une action ex: connexion]
  Action1 --> Dockpulse
  Dockpulse --> Action2[Gère l'action et génère un log]
  Action2 --> Dockpulse
  Dockpulse --> Action3[Envoie message de log]
  Action3 --> Rsyslog
  Rsyslog --> Action4[Traite et stocke log]
  Action4 --> Rsyslog
  Rsyslog --> Action5[Accusé de réception]
  Action5 --> Dockpulse
