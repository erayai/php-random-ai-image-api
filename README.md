# php-random-ai-image-api
# description
this is a random image api powered by ai via php
# deploy
download index.php and upload it to your php server
# how to use
insert
`
<img src="server path/index.php?prompt=your image prompt" />
`
enjoy it

# chat
GET:chat.php?prompt=your prompt
POST:follow openai api (Not support stream)
```
curl "chat.php" \
    -H "Content-Type: application/json" \
    -H "Authorization: Bearer $OPENAI_API_KEY(any key)" \
    -d '{
        "model": "gpt-4o-mini(any model)",
        "messages": [
            {
                "role": "system",
                "content": "You are a helpful assistant."
            },
            {
                "role": "user",
                "content": "Write a haiku that explains the concept of recursion."
            }
        ]
    }'
```
