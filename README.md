# README
Ein Modul für Joomla-Backend. Damit lässt sich eine dynamisch erzeugte Liste aller registrierten Joomla Benutzer als PDF downloaden.

## Getting Started
### Installation
ZIP-File über "Clone or download" - "Download ZIP" herunterladen.
Danach wie gewohnt mit dem Joomla Installationsmanager installieren. Das Modul erscheint dann in der Modulliste der Administrator-Module.

### Moduleinstellungen
In den Moduleinstellungen kann man definieren, nach welchem Kriterium die Tabelleneinträge sortiert werden sollen. Es kann nach Name, Benutzername oder E-Mail-Adresse sortiert werden. Zusätzlich kann definiert werden, ob Auf- oder Absteigend sortiert werden soll.
Standard ist Aufsteigende sortierung nach dem Namen.

## Ändern des Modules zu einem Frontend-Modul
Standardmässig ist dies ein Modul für das Joomla-Backend. Falls man dieses Modul im Frontend haben will, muss das File *mod_userlist.xml* leicht modifiziert werden.
Dazu das File in einem Editor öffnen und Zeile 2
```XML
<extension type="module" version="3.1.0" client="administrator" method="upgrade">
```
ändern zu
```XML
<extension type="module" version="3.1.0" client="site" method="upgrade">
```
### Hinweis
War das Modul vor der Änderung bereits installiert, muss dieses zuerst deinstalliert werden. Danach kann das bearbeitet Modul neu installiert werden.

## Spenden

Falls dir das Modul gefällt, bin ich als Student immer froh um eine kleine Unterstützung meines Hobbys:

<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="C28HUM53S6EC2">
<input type="image" src="https://www.paypalobjects.com/de_DE/CH/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="Jetzt einfach, schnell und sicher online bezahlen – mit PayPal.">
<img alt="" border="0" src="https://www.paypalobjects.com/de_DE/i/scr/pixel.gif" width="1" height="1">
</form>
