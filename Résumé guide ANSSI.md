# Résumé du Guide de l’ANSSI sur la Journalisation

## 1. Objectifs du guide

Le guide de l’ANSSI explique que la journalisation est essentielle pour assurer la sécurité des systèmes d’information. Elle permet de surveiller les activités, de détecter d’éventuels incidents et de comprendre ce qui s’est passé en cas de problème. Le guide fournit des recommandations pour construire un système de journalisation fiable, applicable à tout type de système informatique.

## 2. Prérequis à la mise en place d'un système de journalisation

Le guide recommande de vérifier que les équipements (ordinateurs, serveurs…) peuvent générer des journaux. Ces journaux doivent permettre d’identifier **qui a fait quoi, quand, et depuis quelle machine ou quel compte**.

L’**horodatage** est un élément central. Tous les équipements doivent être synchronisés sur une horloge commune pour garantir la cohérence temporelle des journaux, notamment lors de corrélations multi-machines.

Le document souligne aussi l’importance de **choisir les bons événements à enregistrer** :  
- Trop de données rendent les analyses confuses  
- Trop peu les rendent inefficaces  

Les réglages doivent être adaptés à chaque machine selon sa **criticité**.

Enfin, il est recommandé d’**anticiper suffisamment d’espace disque** pour éviter la perte d’informations, même en cas d’interruption temporaire du serveur de collecte.

## 3. Construction du système de journalisation

L’ANSSI recommande de **centraliser les journaux sur un serveur distinct** pour sécuriser les traces, notamment en cas de compromission d’un poste. Si cela n’est pas faisable, une **copie régulière** vers une autre machine reste une solution acceptable.

Dans les environnements complexes ou répartis géographiquement, le guide propose une **architecture hiérarchisée** avec des serveurs de collecte intermédiaires qui transmettent ensuite les journaux à un serveur principal.

Une **vérification régulière** du bon fonctionnement de cette chaîne est indispensable.

## 4. Transfert et sécurité des données

Le guide présente deux **modes de transfert** :
- **Temps réel** (recommandé) : dès la création des journaux
- **Temps différé** : à intervalles réguliers

Le transfert peut être :
- **Push** : initié par les machines
- **Pull** : initié par le serveur

Chaque mode a ses avantages et ses risques. Un **choix basé sur l’analyse des risques** est conseillé.

La **sécurisation des flux de logs** est indispensable :
- Utiliser des protocoles **fiables (TCP)** et **chiffrés (TLS, SSH, IPsec)**, surtout sur des réseaux non maîtrisés.

Il faut aussi :
- **Maîtriser l’impact réseau**
- **Sécuriser les serveurs de collecte** (à jour, isolés)

## 5. Stockage et protection des journaux

Les journaux doivent être :
- Stockés sur une **partition dédiée**
- Organisés par **type d’événement** ou intégrés dans une **base de données indexée**

Il faut mettre en place :
- Une **politique de rotation** pour éviter que les fichiers ne deviennent trop gros
- Une **durée de conservation conforme aux obligations légales** (6 mois à 3 ans)

L’**accès aux journaux** doit être **strictement limité** aux personnes habilitées.

## 6. Respect des règles et lois

La journalisation peut être une **obligation réglementaire**, notamment pour :
- OIV
- Hébergeurs
- Opérateurs télécoms

Elle doit respecter le **RGPD** :
- Minimiser les données personnelles
- Informer les utilisateurs
- Limiter la durée de conservation
- Contrôler les accès

La **CNIL** recommande généralement de conserver les journaux techniques entre **6 mois et 1 an**, voire **jusqu’à 3 ans** dans certains cas.

## 7. Application du guide ANSSI à notre projet de TP

Dans le cadre de notre TP, le guide de l’ANSSI sert de référence pour concevoir un système de journalisation sécurisé, même dans un environnement réduit.

### ✅ Recommandations retenues

- **Centralisation des journaux** :  
  Les journaux de la VM1 sont centralisés vers VM2 pour sécuriser les traces.

- **Utilisation de rsyslog** :  
  Rsyslog est utilisé côté serveur, comme recommandé par l’ANSSI.

- **Horodatage des logs** :  
  Les deux machines synchronisent l’heure via NTP.

- **Transport via protocole fiable (TCP)** :  
  Rsyslog fonctionne en mode TCP pour garantir la fiabilité.

- **Stockage dans une base MySQL** :  
  Les logs sont stockés dans MySQL, permettant une indexation et des recherches efficaces.

- **Sécurisation des accès** :  
  Les accès à la base MySQL sont restreints pour éviter les modifications ou suppressions accidentelles.

### ⚠️ Recommandations non retenues ou partiellement mises en œuvre

- **Architecture hiérarchique de collecte** :  
  Non applicable ici (seulement deux machines).

- **Tunnel sécurisé (SSH, TLS, IPsec)** :  
  Non mis en place, car le réseau est local et contrôlé.

- **Rotation des logs et politique de rétention** :  
  Pas de rotation automatique mise en place pour ce TP.

- **Supervision avancée de l’espace disque** :  
  Surveillance manuelle uniquement, vu la simplicité du système.

