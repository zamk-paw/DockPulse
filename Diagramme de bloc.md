```mermaid
flowchart TD
    %% Titre du diagramme
    %% Diagramme de blocs - Dockpulse et rsyslog

    %% Acteur
    Utilisateur(["Utilisateur"])

    %% Blocs
    Dockpulse["Dockpulse<br>(Serveur d'application)"]
    Rsyslog["rsyslog<br>(Serveur de logs)"]

    %% Flèches / relations
    Utilisateur -->|Effectue une action<br>(ex: connexion)| Dockpulse
    Dockpulse -->|Gère l'action utilisateur| Dockpulse
    Dockpulse -->|Génère un message de log| Dockpulse
    Dockpulse -->|Envoie le message de log| Rsyslog
    Rsyslog -->|Reçoit et traite le log| Rsyslog
    Rsyslog -->|Accusé de réception| Dockpulse
