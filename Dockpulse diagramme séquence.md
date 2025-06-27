```mermaid
sequenceDiagram
    title Dockpulse et rsyslog

    actor Utilisateur
    participant Dockpulse as "Dockpulse\n(Serveur d'application)"
    participant Rsyslog as "rsyslog\n(Serveur de logs)"

    Utilisateur ->> Dockpulse: Effectue une action\n(ex: connexion)
    Dockpulse ->> Dockpulse: Gère l'action utilisateur
    Dockpulse ->> Dockpulse: Génère un message de log
    Dockpulse ->> Rsyslog: Envoie le message de log
    Rsyslog ->> Rsyslog: Reçoit et traite le log
    Rsyslog -->> Dockpulse: Accusé de réception
