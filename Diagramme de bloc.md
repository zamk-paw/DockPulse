# Diagramme de blocs - Dockpulse et rsyslog

```mermaid
graph TD
    Utilisateur -->|Effectue une action| Dockpulse[Dockpulse\nServeur d'application]
    Dockpulse -->|Gère action utilisateur| Dockpulse
    Dockpulse -->|Génère message log| Dockpulse
    Dockpulse -->|Envoie message log| Rsyslog[rsyslog\nServeur de logs]
    Rsyslog -->|Reçoit et traite log| Rsyslog
    Rsyslog -->|Accusé de réception| Dockpulse
