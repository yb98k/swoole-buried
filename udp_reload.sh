echo "Reloading..."

cmd=`pidof yb_buried_udp`

kill -9 $cmd > /dev/null 2>&1

ps aux | grep buried | grep udp | xargs kill -9 > /dev/null 2>&1

php buried -t udp > /dev/null 2>&1

echo "Reloading Success"
