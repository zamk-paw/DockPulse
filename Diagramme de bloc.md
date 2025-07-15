```mermaid
flowchart TD
    Utilisateur["Utilisateur"]
    Dockpulse["Dockpulse\n(Serveur d'application)"]
    Rsyslog["rsyslog\n(Serveur de logs)"]

    %% Flèches sans label à cause de la syntaxe Mermaid
    Utilisateur --> Dockpulse
    Dockpulse --> Dockpulse
    Dockpulse --> Dockpulse
    Dockpulse --> Rsyslog
    Rsyslog --> Rsyslog
    Rsyslog --> Dockpulse

    %% Légende texte (à placer dans le fichier md pour expliquer les relations)
    %% Utilisateur effectue une action (ex: connexion) --> Dockpulse
    %% Dockpulse gère l'action utilisateur et génère un message de log
    %% Dockpulse envoie le message de log --> Rsyslog
    %% Rsyslog reçoit et traite le log
    %% Rsyslog envoie un accusé de réception --> Dockpulse
