# icecast-geoip
Restrict Icecast2 stream using Geo-IP restriction by continent or country

Requires Maxmind GeoIP/PHP library installed (usually ```sudo apt install php-geoip```)

Place icecast-geoipcheck.php somewhere in your web server root (eg ```/var/www/html/```)

Modify ```/etc/icecast2/icecast.xml```:

```
<mount type="normal">
	<mount-name>/stream</mount-name>
	<username>source</username>
	<password>hackme</password>
	<authentication type="url">
		<option name="listener_add" value="http://localhost/icecast-geoipcheck.php" />
		<option name="auth_header" value="icecast-auth-user: 1" />
	</authentication>
</mount>
```
