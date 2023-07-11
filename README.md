# phoenixapi
API zum Zugriff auf die OpenAI-API für Rocket, unsere eigene LLM-Oberfläche.

# Nutzung der API

__Die API nimmt nur POST-Anfragen entgegen.__


### Parameter

**id**

Sie gibt an, um welches Objekt bzw. um welches Dokument es sich handelt. Die **id** ist immer eine mindestens vierstellige Zahlenfolge.

**chat**

Der Parameter **chat** ist ein _Array_, dass die folgenden Eigenschaften hat:

Jedes Element des Arrays ist ein _Objekt_ (JSON), dass _Schlüssel: Wert_ Elemente enthält. Diese enthalten chronologisch den kompletten Verlauf des Chats.
Chatnachrichten haben die _Rolle_ **system** oder **user**.

Beispiel:

[
    {"role": "user", "content": "Wer bist du?"},
    {"role": "system", "content": "Ich bin dein freundlicher Museumsführer!"}
]

Ist der Parameter **chat** nicht gesetzt, wird davon ausgegangen, dass ein neuer Chat begonnen wird.

### Reply

Als Antwort kommt immer nur die aktuelle Antwort des Systems. Der Chat muss im Frontend zwischengespeichert werden.
