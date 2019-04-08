echo "Reloading..."

cmd=`pidof yb_buried_tcp`

kill -9 $cmd > /dev/null 2>&1

ps aux | grep buried | grep tcp | xargs kill -9 > /dev/null 2>&1

php buried -t tcp > /dev/null 2>&1

echo "Reloading Success"
