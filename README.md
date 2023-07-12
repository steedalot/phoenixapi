# phoenixapi
API zum Zugriff auf die OpenAI-API für Rocket, unsere eigene LLM-Oberfläche.

# Nutzung der API

__Die API nimmt nur POST-Anfragen entgegen.__


### Parameter

**action**

Mögliche Aktionen sind _chat_, _add_ und _modify_. (Vorsicht: _add_/_modify_ müssen noch genauer definiert werden.)

**id**

Sie gibt an, um welches Objekt bzw. um welches Dokument es sich handelt. Die **id** ist immer eine mindestens vierstellige Zahlenfolge.

**chat**

Der Parameter **chat** ist ein _Array_, dass die folgenden Eigenschaften hat:

Jedes Element des Arrays ist ein _Objekt_ (JSON), dass _Schlüssel: Wert_ Elemente enthält. Diese enthalten chronologisch den kompletten Verlauf des Chats.
Chatnachrichten haben die _Rolle_ **assistant** oder **user**. Der Parameter **content** enthält den eigentlichen Text der Nachricht.

Beispiel:

[
    {"role": "user", "content": "Wer bist du?"},
    {"role": "assistant", "content": "Ich bin dein freundlicher Museumsführer!"}
]

Ist der Parameter **chat** nicht gesetzt, wird davon ausgegangen, dass ein neuer Chat begonnen wird. Üblicherweise begrüßt einen der Assistent dann in der definierten Rolle.

### Reply

Als Antwort kommt ein JSON-Objekt mit der aktuellen Antwort des Systems. Der komplette Chat muss im **Frontend** zwischengespeichert werden.

**message**

Enthält die Antwort des Assistenten bzw. die Begrüßung zu Beginn


**finish_reason**

Der Grund, wieso die Antwort endet. Im Idealfall _stop_

**tokens**

Die Länge des letzten Prompts. Hiermit ist der komplette Chatverlauf gemeint, der jedesmal gesendet werden muss. Das Modell verträgt maximal 16000 Tokens.
                
**object**

Gibt die Bezeichnung des aktuellen Objekts / Dokuments zurück, um das es geht (beispielsweise _Augustustatue von Primaporta_).

**role**

Gibt die Rolle zurück, in der der Assistent agiert (beispielsweise _Museumsführer_ oder _IT-Assistent_).
