# Laravel Boolfolio

Creare con Laravel il sistema di gestione del Portfolio di progetti.

## Svolgimento

1. Creare un db "db_portfolio" in phpMyAdmin
2. Collegare il db al progetto Laravel modificando i dati relativi al db nel file .env
3. Effettuare la migration per caricare nel db le migrations esistenti
4. Customizzare i layouts in views (ie. modificare layout guest e aggiungere layout admin)
5. In views, creare le cartelle "guest" e "admin" e inserire all'interno le viste index che estenderanno il layout corrispondente
6. Creare da terminale il controller Guest/PageController (che restituisce le viste guest) ed il controller Admin/DashboardController (che restituisce le viste admin)
7. In routes, aggiornare le rotte a seconda di quando modificato
8. In RouteServiceProvider, effettuare il return alla rotta '/admin'
9. Nel layout admin, includere un header contenente: a) home dashboard admin, b) home sito pubblico, c) nome utente loggato e d) pulsante di logout
10. Creare un modello "Project" (con relativa migrazione, seeder, controller e rotte CRUD) e stampare la index dei progetti che dovrà essere protetta da middleware
11. Aggiungere anche un modello "Technology" ed uno "Type" (con relativa migrazione, seeder, controller e rotte CRUD) ipotizzandone per ciascuna la gestione in un'unica pagina
12. Aggiungere gestione caricamento immagini
13. Aggiungere la relazione one to many fra i projects e i type
14. Aggiungere una relazione many to many fra i projects e le technologies
15. Creare il seeder per la tabella pivot project_technology
16. Aggiungere un Api/ProjectController che restituisca la lista dei progetti presenti nel database in formato json
