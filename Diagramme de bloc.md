graph TD
    U[Utilisateur]

    subgraph DP[Dockpulse (Serveur d'application)]
        DP1[Gestion des actions utilisateur]
        DP2[Création de logs]
        DP3[Transmission logs vers rsyslog]
    end

    subgraph RS[rsyslog (Serveur de logs)]
        RS1[Réception des logs]
        RS2[Analyse / Traitement des logs]
        RS3[Accusé de réception]
    end

    U --> DP1
    DP1 --> DP2
    DP2 --> DP3
    DP3 --> RS1
    RS1 --> RS2
    RS2 --> RS3
    RS3 --> DP3
