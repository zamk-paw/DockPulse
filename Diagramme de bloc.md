```mermaid
flowchart TD
    Utilisateur["Utilisateur\n(block)"]
    Dockpulse["Dockpulse\n(block)"]
    rsyslog["rsyslog\n(block)"]

    Utilisateur -- "initie action" --> Dockpulse
    Dockpulse -- "envoie logs" --> rsyslog
    rsyslog -- "ack" --> Dockpulse
