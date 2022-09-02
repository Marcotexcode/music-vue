---
name: Titolo
about: Suggest an idea for this project
title: ''
labels: ''
assignees: ''

---

## Introduzione
Quando aggiungi un ordine di manutenzione sei costretto ad aggiungerci anche un allegato, altrimenti da errore, correggere il bug rendendo l'aggiunta di un allegato opzionale.

## Info
- Tipo: Bug
- Origine richiesta: Marco il 01/09/2022
- Stima in ore/giorni: 1 ora
- Branch: feature/bug_allegato

## Descrizione dettagliata
Aggiungere una condizione che indica che se la richiesta ($request->allegati_ids) è null allora non salvare l'allegato 

## Analisi e steps per risoluzione della issue
_(qui si scompone il da farsi in passetti elementari)_
- [x] aggiungere condizione al controller 

## Domande da fare al cliente
- [ ] Chiedere al cliente se l'allegato lo vogliono opzionale o obbligatorio

## Indicazione di massima dei test da aggiungere
- [x] Aggiungere un test in cui viene creato un odm senza allegato e verificare che non ritorna errore.
- [x] Aggiungere un test in cui viene modificatoun odm senza allegato e verificare che non ritorna errore.

## Rilascio
_(Indicare se va modificato un rilascio esistente (e linkare quale) o se va creato un rilascio nuovo.)_
