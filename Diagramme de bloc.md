# Diagramme de blocs - Dockpulse et rsyslog

```plantuml
@startuml
title Diagramme de blocs - Dockpulse et rsyslog

actor Utilisateur

rectangle "Dockpulse\n(Serveur d'application)" as Dockpulse
rectangle "rsyslog\n(Serveur de logs)" as Rsyslog

Utilisateur --> Dockpulse : Effectue une action\n(ex: connexion)
Dockpulse --> Dockpulse : Gère l'action utilisateur
Dockpulse --> Dockpulse : Génère un message de log
Dockpulse --> Rsyslog : Envoie le message de log
Rsyslog --> Rsyslog : Reçoit et traite le log
Rsyslog --> Dockpulse : Accusé de réception

@enduml
