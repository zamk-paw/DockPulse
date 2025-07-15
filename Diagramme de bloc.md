# Diagramme de blocs - Dockpulse et rsyslog

```mermaid
graph TD
    Utilisateur -->|Effectue une action (ex: connexion)| Dockpulse[Dockpulse<br>(Serveur d'application)]
    Dockpulse -->|Gère l'action utilisateur| Dockpulse
    Dockpulse -->|Génère un message de log| Dockpulse
    Dockpulse -->|Envoie le message de log| Rsyslog[rsyslog<br>(Serveur de logs)]
    Rsyslog -->|Reçoit et traite le log| Rsyslog
    Rsyslog -->|Accusé de réception| Dockpulse
