<?php
$config['control']['enable'] = true;
$config['control']['speed'] = 60;
$config['control']['max_ram'] = 100;
////////////////////////////////////////////
////////////////NIE ZMIENIAJ///////////////
////////////////////////////////////////////
$config['bot']['loop']['interval']=Array('days' => 0, 'hours' => 0, 'minutes' => 1, 'seconds' => 0);
$config['bot']['loop']['datazero']= '1970-01-01 00:00:00';
$config['bot']['loop']['enable'] = true;

////////////////////////////////////////////
////////////////////////////////////////////
////////////////////////////////////////////
$config[1]['server']['defaultchannel'] = 28;
$config[1]['server']['defaultgroup'] = 8;

////////////////////////////////////////////
/////////////////LNGUAGE////////////////////
////////////////////////////////////////////
$config['bot']['laguage'] = "pl";  //język
////////////////////////////////////////////
/////////////FIRST INSTANCE/////////////////
////////////////////////////////////////////
$config[1]['enable'] = true; 

$config[1]['server']['ip'] = '127.0.0.1'; //ip serwera
$config[1]['server']['port'] = 9987; //port serwera
$config[1]['server']['queryport'] = 10011; //port server query
$config[1]['query']['login'] = 'serveradmin'; //nazwa server query
$config[1]['query']['password'] = ''; //hasło server query
$config[1]['bot']['name'] = "#1"; //nazwa bota
$config[1]['bot']['channel'] =  28; //domyślny kanał bota
$config[1]['bot']['speed'] = 1; //intertwał bota

$config[1]['functions'] = Array('day', 'hour','useronline' ,'register' ,'recordonline' ,'afk' ,'pgroup' ,'banlist' ,'channelscount' ,'visitors', 'packetloss', 'ping', 'uptime', 'generatebanner', 'channelzoneclient', 'adminslist', 'timeleft');

		// Day // Dzień
//Funkcja generuje datę w nazwie kanału
 $config['function']['day'] = Array(
	'enable' => true,
	'channel' => 1096,  //id kanału
	'channelname' => "[cspacer0]● [DAY].[MONTH].[YEAR] ●",  //nazwa kanału, [DAY], [MONTH], [YEAR]
	'interval' => Array('days' => 0, 'hours' => 1, 'minutes' => 0, 'seconds' => 0),  //interwał
	'datazero' => '1970-01-01 00:00:00',
 );

		// Hour // Godzina
//Funkcja generuje godzinę w nazwie kanału
$config['function']['hour'] = Array(
	'enable' => true,
	'channel' => 9,  //id kanału
	'channelname' => "[cspacer0]● Godzina: [HOUR]:[MINUTES] ●",  //nazwa kanału, [HOUR],[MINUTES]
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 30), //interval
	'datazero' => '1970-01-01 00:00:00'
);
	
		// User online //  Użytkowników online
//Funkcja generuje liczbę użytkowników w nazwie kanału
$config['function']['useronline'] = Array(	
	'enable' => true,
	'channel'=> 8,  //id kanału
	'channelname' => "[cspacer]● Online: [ONLINE] ([%]%)●",  //nazwa kanłu  [ONLINE] - użytkowników online, [%] - procentowe zapełnienie serwera
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 5), //interval
	'datazero' => '1970-01-01 00:00:00'
);
	
		// Register //  Rejestracja
//Funkcja służy do nadawanie rangi rejestracyjnej po wejściu na oreślony kanał
$config['function']['register'] = Array(
	'enable' => true,
	'allgroup' => Array(14,15,87),	//wszystkie grupy	
	'channeldelgroup' => 1061,  //id kanału na którym zostaną usunięte rangi rejestracyjne
	'info' => Array(
		1 => Array(
			'group' => 14,  //id grupy
			'channel' => 90  //id kanału
		),
		2 => Array(
			'group' => 15,
			'channel' => 91,
		),
		3 => Array(
			'group' => 87,
			'channel' => 528
		)
	),
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 1), //interval
	'datazero' => '1970-01-01 00:00:00'
);
	
		// Rekord online //  Rekord online
//Funkcja wyświetla rekord użytkowników online w nazwie kanału
$config['function']['recordonline'] = Array(
	'enable' => true,
	'channel' => 11, //id kanału
	'channelname' => "[cspacer]●Rekord onlnie: [RECORD] ●",  //nazwa kanału
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 5), //interval
	'datazero' => '1970-01-01 00:00:00'
);

		// AFK //
//Funkcja zarządza użytkownikami afk
$config['function']['afk'] = Array(
	'enable' => false,
	'mode' => 2, //1 - przenieś na kanał; 2 - nadaj range,
	'idlechannel' => 677, //id kanału, jeśli mode = 1
	'afkgroup' => 89, //id grupy afk, jeśli mode = 2
	'idletime' => 30,  //Czas po którym użytkownik zostanie przeniesiony, jeśli mode = 2 
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 2), //interval
	'datazero' => '1970-01-01 00:00:00'
);

		// Poke group //  Zaczepianie grup
//Funkcja zaczepia wybrane grupy co określony czas
$config['function']['pgroup'] = Array(
	'enable' => true,
	'info' => Array(
		1 => Array(
			'group' => 8, //id grupy
			'message' => "Pamiętaj aby zarejestrować się (rejestracja dostępna w strefie pomocy)."  //wiadomość
		)
	),
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 20, 'seconds' => 0), //interval
	'datazero' => '1970-01-01 00:00:00'
);
	
		// Ban list //  Lista banów
//Funkcja generuje w opisie kanału liste banów
$config['function']['banlist'] = Array(
	'enable' => true,
	'channel_name_enable' => true, //generowani nazwy kanału
	'channel' => 111,  //id kanału
	'channel_name' => "[cspacer]● Lista banów [COUNT]●",  //nazwa kanału, jeśli jest włączona  [COUNT] - liczba banów
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 30, 'seconds' => 0), //interval
	'datazero' => '1970-01-01 00:00:00'
);
	
		// channels count //  Liczba kanałów
//Funkcja generuje liczbę kanałów w nazwie kanału
$config['function']['channelscount'] = Array(
	'enable' => true,
	'channel' => 648,  //id kanału
	'channelname' => "[cspacer]● Kanałów ogółem: [COUNT] ●",  //nazwa kanału, [COUNT] - liczba kanałów
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 2, 'seconds' => 0), //interval
	'datazero' => '1970-01-01 00:00:00'
);
	
		// Visitors //  Wizyt
//Funkcja generuje liczbę odwiedzin w nazwie kanału
$config['function']['visitors'] = Array(
	'enable' => true,
	'channel' => 148,  //id kanału
	'channelname' => "[cspacer0]●Odwiedzin: [COUNT] (od resetu)●",  //nazwa kanału, [COUNT] - liczba odwiedziń
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 5), //interval
	'datazero' => '1970-01-01 00:00:00'
);

		// Packet loss //   Utrata pakietów
//Funkcja generuje średnią liczbę utraty pakietów w nazwie kanału
$config['function']['packetloss'] = Array(
	'enable' => false,
	'channel' => 1101,  //id kanału
	'channelname' => "[cspacer0]●Średnia utrata pakietów: [COUNT]% ●",  //nazwa kanału, [COUNT] - utrata pakietów
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 5), //interval
	'datazero' => '1970-01-01 00:00:00'
);

		// Ping //  Ping
//Funkcja generuje średni ping w nazwie kanału
$config['function']['ping'] = Array(
	'enable' => false,
	'channel' => 992,  //id kanału
	'channelname' => "[cspacer0]●Średni ping: [COUNT] ms●",  //nazwa kanału, [COUNT] - średni ping
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 5), //interval
	'datazero' => '1970-01-01 00:00:00'
);

		// Uptime //  Czas działania
//Funkcja generuje czas działania serwera w nazwie kanału
$config['function']['uptime'] = Array(
	'enable' => false,
	'channel' => 992,  //id kanału
	'channelname' => "[cspacer0]●Czas działania: [COUNT]●",  //nazwa kanału, [COUNT] - czas działania serwera
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 5), //interval
	'datazero' => '1970-01-01 00:00:00'
);

		// Generate banner //  Generowanie bannera
//Funkcja generuje banner
$config['function']['generatebanner'] = Array(
	'enable' => true,
	
//użytkownicy online	
	'useronline' => Array(
	'enable' => true,
	'color' => Array(255,255,255),  //kolor rgb
	'font' => "brlnsdb",  //czcionka (arial, brlnsdb, calibri, katana, tahoma)
	'position' => Array(40,0,105,171)  // (rozmiar, rotacja, pozycja x, pozycja y)
	),

//liczba administracji online	
	'adminonline' => Array(
	'enable' => true,
	'adminsgroup' => Array(6,30),
	'color' => Array(255,255,255),
	'font' => "brlnsdb",
	'position' => Array(40,0,850,171)
	),

//rekord online
	'recordonline' => Array(
	'enable' => false,
	'color' => Array(255,255,255),
	'font' => "brlnsdb",
	'position' => Array(40,0,105,325)
	),

//rekord miesiąca	
	'monthrecord' => Array(
	'enable' => false,
	'color' => Array(255,255,255),
	'font' => "brlnsdb",
	'position' => Array(40,0,105,325)
	),

//godzina
	'time' => Array(
	'enable' => true,
	'color' => Array(255,255,255),
	'font' => "brlnsdb",
	'position' => Array(40,0,440,103)
	),

//data	
	'date' => Array(
	'enable' => false,
	'color' => Array(255,255,255),
	'font' => "brlnsdb",
	'position' => Array(40,0,105,325)
	),
	
	'image' => "include/cache/bg.png",  //lokalizacja banera
	'savethere' => "/var/www/html/image.png",  //lokalizacja, gdzie zostanie wygenerowany banner
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 10), //interval
	'datazero' => '1970-01-01 00:00:00'
);

		// Channel zone clients count // Liczba użytkowników w strefie
//Funkcja generuje liczbę użytkowników w danej strefie w nazwie kanału
$config['function']['channelzoneclient'] = Array(
	'enable' => true,
	'info' => Array(
		1 => Array(
			'channel' => 1214,  //id kanału
			'channelname' => "[cspacer0]Klientów: [count]",  //nazwa kanału, [count] - liczba klientów
			'channelzonestart' => 265,  //id kanału, gdzie zaczyna się liczenie użytkoników
			'channelzonestop' => 1212  //id kanału, gdzie kończy się liczenie użytkoników
		),
		2 => Array(
			'channel' => 1213,
			'channelname' => "[cspacer1]Klientów: [count]",  
			'channelzonestart' => 35,
			'channelzonestop' => 307
		),
	),
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 10), //interval
	'datazero' => '1970-01-01 00:00:00'
);

		// Admins list //  Lista administracji
//Funkcja generuje listę administracji w nazwie kanału
$config['function']['adminslist'] = Array(
	'enable' => false,
	'channel' => 992, //id kanału
	'group' => Array(30, 6),  //wszystkie grupy administracyjne
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 30), //interval
	'datazero' => '1970-01-01 00:00:00'
);

		// Time left //  Odliczanie do daty
//Funkcja wyświetla pozostały czas do danego wydarzenia w nazwie kanału
$config['function']['timeleft'] = Array(
	'enable' => false,
	'info' => Array(
		1 => Array(
			'channel' => 992,  //id kanału
			'channelname' => "urodziny admina: [left]",  //nazwa kanału  [left] - pozostały czas
			'time' => "27.11.2018 12:30", // d.m.YYYY h:m
			'channelnameafter' => "Happy"  //nazwa kanału po minięciu daty
		),
		2 => Array(
			'channel' => 1058,
			'channelname' => "urodziny admina: [left]",
			'time' => "31.12.2017 0:0", // d.m.YYYY h:m
			'channelnameafter' => "Happy"
		)
	),
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 30), //interval
	'datazero' => '1970-01-01 00:00:00'
);

/////////////////////////////////////////
/////////////SECOND INSTANCE/////////////
/////////////////////////////////////////
$config[2]['enable'] = true;

$config[2]['server']['ip'] = '127.0.0.1'; //ip serwera
$config[2]['server']['port'] = 9987; //port serwera
$config[2]['server']['queryport'] = 10011; //port server query
$config[2]['query']['login'] = 'serveradmin'; //nazwa server query
$config[2]['query']['password'] = ''; //hasło server query
$config[2]['bot']['name'] = "#2"; //nazwa bota
$config[2]['bot']['channel'] =  28; //domyślny kanał bota
$config[2]['bot']['speed'] = 1; //intertwał bota
$config[2]['bot']['icons']['enable'] = true;  //generowanie ikon
$config[2]['bot']['icons']['localization'] = "/var/www/html/icon/icons/";  //lokalizacja generowania ikon
$config[2]['bot']['icons']['adress'] = "https://xtrust.pl/icon/icons/";  //adres www ikon

$config[2]['functions'] = Array('groupclientcount', 'privatechannel', 'checkchannels', 'servername', 'clientstatus', 'timechannel', 'imieniny', 'monthrecord', 'youtube', 'twitch', 'welcomemessage', 'pokeonchannel', 'vpndetection', 'advertisement', 'botinfo', 'ddosdetection', 'antyrecording', 'nickcontrol', 'gameinfo');

		// Group client count //  Liczba użytkowników grupy
//Funkcja generuje liczbę użytkowników danej grupy serwerowej w nazwie kanału
$config['function']['groupclientcount'] = Array(
	'enable' => true,
	'info' => Array(
		1 => Array  
			(
			'channel' => 286,  //id kanału
			'group' => 30,  //id grupy
			'channelname' => '[cspacer][RANG] Online: [ONLINE] / [MAX]',  //nazwa kanału, [RANG] - nazwa rangi, [ONLINE] - użytkowników online, [MAX] - łączna ilość użytkowników
		),
		2 => Array  
			(
			'channel' => 287,
			'group' => 6,  
			'channelname' => '[cspacer][RANG] Online: [ONLINE] / [MAX]',
		),
		3 => Array  
			(
			'channel' => 485,
			'group' => 28,  
			'channelname' => '[cspacer][ONLINE]/[MAX]',
		)
		
	),
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 5),  //interval
	'datazero' => '1970-01-01 00:00:00'
);
	
		// Private channel //  Prywatny kanał
//Funkcja służy do nadawania kanałów prywatnych
$config['function']['privatechannel'] = Array(
	'enable' => true,
	'clientonchannel' => 93, //id kanału, na którym można dostać prywatny kanał
	'needgroup' => Array(14,15),  //wymagane grupy aby dostać kanał
	'channelzone' => 265, //strefa kanałów prywatnych
	'admingroup' => 5,  //id grupy kanałowej administratora kanału
	'subchannels' => 2, //liczba podkanałów
	'channeltopic' => "#free", //temat w wolnych kanałach
	'messageafter' => "Pamiętaj o zmianie hasła",  //wiadomość po otrzymaniu kanału
	'channelname' => "Kanał prywatny - [NICK]",  //nazwa kanału
	'subchannelname' => "Podkanał",  //nazwa podkanałów
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 1),  //interval
	'datazero' => '1970-01-01 00:00:00'
);
	
		// Check channels //  Sprawdzanie kanałów
//Funkcja służy do sprawdzania kanałów prywatnych
$config['function']['checkchannels'] = Array(
	'enable' => true,
	'channelzone' => 265,  //strefa kanałów prywatnych
	'channelzonename' => "[cspacer]Kanałów prywatnych: [COUNT]",  //nazwa głównego kanału strefy, [COUNT] - liczba kanałów prywatnych
	'channeltopic' => "#free", //temat w wolnych kanałach
	'freechannelscount' => 5,  //minimalna liczba wolnych kanałów
	'channelslist' => 265,  //id kanału, w którym zostaną wypisane wolne i zajęte kanały
	'channelname' => "[NUMBER]. Kanał prywatny - wolny",  //Nazwa wolnego kanału
	'intervaldelete' => 7, //liczba dni, po których kanał zostanie usuniety 
	'setdate' => true, //ustawianie aktualnej daty, jeśli ktoś znajduje się na kanale
	'checkname' => true, //sprawdzanie nazw kanałów
	'block' => "chuj,kurwa,szmata,huj,chój,hój,kórwa,zajebać,zajebac,zapierdalać,zapierdalac,zapierdolić,zapierdolic,zjeb,zajebać,zajebac,wpierdol,wpierdalać,wpierdalac,wkurwienie,wkurwiony,wychujać,wychujac,wykurwiście,wykurwiscie,ujebać,ujebac,ujebany,upierdolony,suka,sóka,sukinsyn,sókinsyn,sukinkot,sókinkot,spierdolić,spierdolic,spierdalać,spierdalac,skurwysyństwo,skurwysynstwo,skurwysynowanie,skurwysynek,zkurwysyn,skurwiel,zkurwiel,skurwiały,surwialy,zkurwiały,zkurwialy,przyjebać,przyjebac,przerżnąć,przerznac,przejebane,przechuj,przehuj,porucha,popierdolony,pojeb,pojebać,pojebac,pojebany,podjebac,podjebać,pizda,pizdeczka,pierdolony,pierdolnik,pierdolnięty,pierdolniety,opierdalać,opierdalac,odpierdalać,odpierdalac,matkojebca,kozojebca,kurrewka,kurewski,kurewsko,kurwić,kurwic,kutas,jebać,jebac,jebanie,jebanko,jebany,jebaństwo,jebnąć,jebnac,dojebać,dojebac,dopierdolić,dopierdolic,dopierdoloenie,dziwka,dzifka,chujnia,hujnia,chujowy,hujowy,cwel,cfel,cipa,cipka,cipeczka,rucham,TeamSpeakUser,[RooT],[HSA]", //zabronione słowa w nazwach kanałów
	'message' => "Zmień nazwę kanału",  //nazwa kanału, jeśli nazwa kanału zawiera zabronione słowo
	'intervalname' => Array('days' => 0, 'hours' => 0, 'minutes' => 1, 'seconds' => 0),  //interwał sprawdzania nazw kanałów
	'datazeroname' => '1970-01-01 00:00:00',
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 2),  //interval
	'datazero' => '1970-01-01 00:00:00'
);
	
		// Server name //  Nazwa serwera
//Funkcja zmienia nazwę serwera 
$config['function']['servername'] = Array(
	'enable' => true,
	'channelname' => "xTrust.pl [ONLINE]/[MAX]",  //nazwa serwera
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 5),  //interval
	'datazero' => '1970-01-01 00:00:00'
);
	
		// Client status //  Status użytkownika
//Funkcja generuje status użytkownika w nazwie kanału oraz dokładniejsze informacje w opisie kanału
$config['function']['clientstatus'] = Array(
	'enable' => true,
	'aalgroup' => Array(6, 30),  //wszystkie id grup
	'steamstatus' => true,  //status steam
	'steamapi' => "A3F4695EEF3317F8EE14941692AA7BA6",  //steam api
	'info' => Array(
		1 => Array(
			'dbid' => 2, //dbid użytkownika
			'channel' => 184,  //id kanału
			'steamid' => 76561198101162681  //steam id użytkownika
			),  //steamid64
		2 => Array(
			'dbid' => 1824,
			'channel' => 190,
			'steamid' => 76561198257069727
		),
		3 => Array(
			'dbid' => 797,
			'channel' => 187,
			'steamid' => 76561198088102844
		),
		4 => Array(
			'dbid' => 636,
			'channel' => 188,
			'steamid' => 76561197963803454
		),
		5 => Array(
			'dbid' => 1283,
			'channel' => 189,
			'steamid' => 76561198167928642
		),
		6 => Array(
			'dbid' => 12,
			'channel' => 186,
			'steamid' => 76561198345510948
		),
	
	),
	'channelname' => "[cspacer]◥◣━[RANG]┃[NICK]┃[STATUS]━◢◤",  //nazwa kanału, [RANG] - ranga, [NICK] - nazwa użytkownika, [STATUS] - status na teamspeak
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 10),  //interval
	'interval2' => Array('days' => 0, 'hours' => 0, 'minutes' => 2, 'seconds' => 0),  //interwał aktualizowania informacji w opisach kanałów
	'datazero' => '1970-01-01 00:00:00',
	'datazero2' => '1970-01-01 00:00:00'
);

		// Time channel //  Kanał czasowy
//Funkcja służy do otwierania kanału w określonych godzinach
$config['function']['timechannel'] = Array(
	'enable' => false,
	'info' => Array(
		1 => Array(
			'channel' => 992,  //id kanału
			'channelnameon' => "Działa",  //nazwa kanału, gdy jest dostępny
			'channelnameoff' => "Nie działa",  //nazwa kanału, gdy jest niedostępny
			'timeon' => "9:54",
			'timeoff' => "19:51"
		),
		2 => Array(
			'channel' => 993,
			'channelnameon' => "Działa2", 
			'channelnameoff' => "Nie działa2",
			'timeon' => "8:00",
			'timeoff' => "9:53"
		)
	),
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 1),  //interval
	'datazero' => '1970-01-01 00:00:00'
);

		// Imieniny //  
//Funkcja generuje imiona osób obchodzące imieniny w nazwie kanału
$config['function']['imieniny'] = Array(
	'enable' => false,
	'channel' => 992,  //id kanału
	'channelname' => "Imieniny: [NAME]",  //nazwa kanału, [NAME] - imiona
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 1),  //interval
	'datazero' => '1970-01-01 00:00:00'
);

// Month record //  Rekord miesiąca
//Funkcja generuje rekord miesiąca w nazwie kanału
$config['function']['monthrecord'] = Array(
	'enable' => true,
	'channel' => 857,//id kanału
	'channelname' => "[cspacer]● Rekord miesiąca: [RECORD] ●",  //nazwa kanału, [RECORD] - rekord
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 5), //interval
	'datazero' => '1970-01-01 00:00:00'
);

		// Youtube //
//Funkcja wyświetla liczbę subskrybcji kanału youtube w nazwie kanału oraz wyświetla dokładniejsze informacje w opisie
$config['function']['youtube'] = Array(
	'enable' => true,
	'youtubeapi' => "AIzaSyDovcc8n_eHnRuTwKItjJLaPkFwG-u7lWk",  //youtube api
	'channnelname' => "[cspacer]✯[NICK] - [SUBSCOUNT]✯",  //nazwa kanału, [NICK] - nazwa kanału, [SUBSCOUNT] - liczba subskrybcji
	'info' => Array(
		1 => Array(
			'channelid' => 611,  //id kanału
			'youtubechannel' => "UCswiY-euT4t-0gq-_2dZwKA"  //kanał yooutube
		)
	),
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 1, 'seconds' => 0), //interval
	'datazero' => '1970-01-01 00:00:00'
);

		// Twitch //
//Funkcja wyświetla status streama na Twitchu w nazwie kanału oraz wyświetla dokładniejsze informacje w opisie
$config['function']['twitch'] = Array(
	'enable' => false,
	'twitchapi' => "352ei7jf3jq2mu6jvvovjy4qwv6huc",  //twitch api
	'channelname' => "[cspacer]✯[NICK] - [STATUS]✯",  //nazwa kanału, [NICK] - nazwa kanału,  [STATUS] - status 
	'info' => Array(
		1 => Array(
			'channelid' => 992,  //id kanału
			'channelname' => "izakooo"  //nazwa kanału
		)
	),
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 1, 'seconds' => 0), //interval
	'datazero' => '1970-01-01 00:00:00'
);

		// Welcome message //  Wiadomość powitalna
//Funkcja generuje wiadomość powitalną
$config['function']['welcomemessage'] = Array(
	'enable' => true,
	'mode' => 1,  //1 - zaczep, 2 - wyślij wiadomość
	'message' => "		[b]Teraz jest [online]/[max] osób![/b]\n Jesteś youtuberem/streamerem? Napisz do nas!",  //nazwa kanłu, [online] - użytkowników online, [max] - liczba slotów
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 2), //interval
	'datazero' => '1970-01-01 00:00:00'
);

		// Poke on channel //  Zaczepianie na kanale
//Fukcja zaczepia wybrane grupy, gdy ktoś znajduje się na danym kanale
$config['function']['pokeonchannel'] = Array(
	'enable' => true,
	'info' => Array(
		1 => Array(
			'channel' => 33,  //id kanału
			'pokegroup' => Array(6,30),  //id grup do zaczepienia
			'message' => "[NICK] ma skargę"  //wiadomość
		)
	),
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 30), //interval
	'datazero' => '1970-01-01 00:00:00'
);

		// VPN detection //  Wykrywanie VPN
//Funkcja wykrywa VPS u użytkowników (aktualnie nie działa)
$config['function']['vpndetection'] = Array(
	'enable' => false,
	'ignore' => Array(6, 30),  //ignorowane grupy
	'key' => "111111-222222-333333-444444",
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 5, 'seconds' => 0), //interval
	'datazero' => '1970-01-01 00:00:00'
);

		// advertisement //  Reklama
//Funkcja wysyła co dany czas wiadomość na serwer
$config['function']['advertisement'] = Array(
	'enable' => false,
	'message' => "Wiadomość [online]/[max]",  //wiadomość [online] - użytkowników online, [max] - łączna liczba użytkowników
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 5), //interval
	'datazero' => '1970-01-01 00:00:00'
);

		// Bot info //  Informacje o bocie
//Funkcja wyświetla informacje o instancjach bota w opise kanału
$config['function']['botinfo'] = Array(
	'enable' => true,
	'channel' => 1074, //id kanału
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 2, 'seconds' => 0), //interval
	'datazero' => '1970-01-01 00:00:00'
);

		// Ddos detection //  Wykrywanie ataków Ddos
//Fukcja wykrywa atak Ddos i wysyła wiadomość na serwer
$config['function']['ddosdetection'] = Array(
	'enable' => true,
	'packetloss' => 10, //średni loss na serwerze
	'message' => "[b]Wykryto atak Ddos[/b]",  //wiadomość
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 30), //interval
	'datazero' => '1970-01-01 00:00:00'
);

		// Anty recording //  Blokada nagrywania
//Funcja wykrywa osoby nagrywające na serwerze
$config['function']['antyrecording'] = Array(
	'enable' => true,
	'mode' => 2,  // 1 - zaczep, 2 - wyrzuć z serwera
	'message' => "[b]Wyłącz nagrywanie[/b]",  //wiadomość
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 10), //interval
	'datazero' => '1970-01-01 00:00:00'
);

		// Nick control //  Kontrola nicków
//Funkcja sprawdza nazwy użytkowników
$config['function']['nickcontrol'] = Array(
	'enable' => true,
	'block' => "chuj,kurwa,szmata,huj,chój,hój,kórwa,zajebać,zajebac,zapierdalać,zapierdalac,zapierdolić,zapierdolic,zjeb,zajebać,zajebac,wpierdol,wpierdalać,wpierdalac,wkurwienie,wkurwiony,wychujać,wychujac,wykurwiście,wykurwiscie,ujebać,ujebac,ujebany,upierdolony,suka,sóka,sukinsyn,sókinsyn,sukinkot,sókinkot,spierdolić,spierdolic,spierdalać,spierdalac,skurwysyństwo,skurwysynstwo,skurwysynowanie,skurwysynek,zkurwysyn,skurwiel,zkurwiel,skurwiały,surwialy,zkurwiały,zkurwialy,przyjebać,przyjebac,przerżnąć,przerznac,przejebane,przechuj,przehuj,porucha,popierdolony,pojeb,pojebać,pojebac,pojebany,podjebac,podjebać,pizda,pizdeczka,pierdolony,pierdolnik,pierdolnięty,pierdolniety,opierdalać,opierdalac,odpierdalać,odpierdalac,matkojebca,kozojebca,kurrewka,kurewski,kurewsko,kurwić,kurwic,kutas,jebać,jebac,jebanie,jebanko,jebany,jebaństwo,jebnąć,jebnac,dojebać,dojebac,dopierdolić,dopierdolic,dopierdoloenie,dziwka,dzifka,chujnia,hujnia,chujowy,hujowy,cwel,cfel,cipa,cipka,cipeczka,TeamSpeakUser,rucham,[RooT],[HSA]", //blokowane słowa
	'message' => "Zmień nick",  //wiadomość
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 1, 'seconds' => 0), //interval
	'datazero' => '1970-01-01 00:00:00'
);

		// Game info //  Informacje o serwerze gry
//Fukcja wyświetla w nazwach kanałów informacje o serwerze z gier cs:go i mc, które są dodane na stronę gametracker.com
$config['function']['gameinfo'] = Array(
	'enable' => false,
	'info' => Array(
		1 => Array(
			'game' => "csgo",  //gra  (csgo - Counter Strike Global Ofensive, mc - Minecraft)
			'channel' => 992,  //id kanału
			'servername' => "Counter Strike [ONLINE]/[MAX]",  //nazwa kanłu, [ONLINE] - liczba graczy online, [MAX] - liczba slotów
			'serverip' => "137.74.1.201:27195",
		),
		2 => Array(
			'game' => "mc",
			'channel' => 1058,
			'servername' => "Minecraft [ONLINE]/[MAX]",
			'serverip' => "37.187.137.123:25565",
		),
	),
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 30), //interval
	'datazero' => '1970-01-01 00:00:00'
);

/////////////////////////////////////////
/////////////HELP CHANNEL/////////////
/////////////////////////////////////////
$config[3]['enable'] = true;

$config[3]['server']['ip'] = '127.0.0.1'; //ip serwera
$config[3]['server']['port'] = 9987; //port serwera
$config[3]['server']['queryport'] = 10011; //port server query
$config[3]['query']['login'] = 'serveradmin'; //nazwa server query
$config[3]['query']['password'] = ''; //hasło server query
$config[3]['bot']['name'] = "LiveHelp"; //nazwa bota
$config[3]['bot']['channel'] =  28; //domyślny kanał bota
$config[3]['bot']['speed'] = 1; //intertwał bota

$config[3]['functions'] = Array('helpchannel');

		// Help channel //  Kanał pomocy
//Fukcja służy do automatycznej pomocy użytkownikom
$config['function']['helpchannel'] = Array(
	'channel' => 30,  //id kanału
	'channeldesc' => "[COMMAND]",  //opis kanału, [COMMAND] - komendy
	'admingroup' => Array(6, 30),  //id grup administracyjnych
	'channeladmingroups' => Array(5,10),  //id grup administratorów kanałów
	'bangroup' => 18,  //id gupy banującej na kanale
	'commandlist' => "!komendy", //lista komend
	'grouplist' => "!grupy",  //komenda do listy dostępnych grup
	'adminpokemessage' => "[NICK] potrzebuje pomocy!",  //wiadomość do administracji, po uźyciu komendy !admin
	'needgroupall' => Array(14,15),  //wymagane grupy do uzyskania pomocy
	'ignoredonchannel' => Array(191,292),  //kanały, na których administracja nie jest zaczepiana
	'profilelinkenable' => true,  //link do profilu
	'profilelink' => "xtrust.pl/stats",  //adres strony
	//rejestracja
	'needgroup' => Array(  
		1 => Array(
			'groupid' => 14,  //id grupy
			'command' => "!m"  //komenda
		),
		2 => Array(
			'groupid' => 15,
			'command' => "!k"
		),
	),
	'servergroup' => Array(19,20,21,22,23,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,88,83),  //dostępne grupy serwerowe
	'maxservergroup' => 6,  //maksymalna ilość grup
	'channeldesctopic' => "[center][size=15][b]Komendy[/b][/size][/center]",  //opis kanału
	'msgtoadminenable' => true, //wiadomość do administracji, jeśli 4 instancja jest włączona
	'msgtoadminchannel' => 17, //id kanału, w którym zostaną wypisane wiadomości do administracji
	'msgtoadminmax' => 12,  //maksymalna ilość wiadomości do administracji
	'msgtoadmindelete' => true,  //usuwanie starszych wiadomości
	//własne komendy
	'info' => Array(
		1 => Array(
	'command' => "!poziomy",  //komenda
	'message' => "\n[b]Spis poziomów:[/b]
1 poziom - 1 godzina
2 poziom - 2 godziny
3 poziom - 4 godziny
4 poziom - 8 godziny
5 poziom - 12 godziny
6 poziom - 18 godziny
7 poziom - 1 dzień
8 poziom - 2 dni
9 poziom - 3 dni
10 poziom - 5 dni
11 poziom - 7 dni
12 poziom - 9 dni
13 poziom - 11 dni
14 poziom - 13 dni
15 poziom - 15 dni 
16 poziom - 18 dni
17 poziom - 21 dni
18 poziom - 24 dni
19 poziom - 27 dni
20 poziom - 30 dni
21 poziom - 33 dni
22 poziom - 36 dni
23 poziom - 39 dni
24 poziom - 42 dni
25 poziom - 45 dni
26 poziom - 50 dni
27 poziom - 55 dni
28 poziom - 60 dni
29 poziom - 75 dni
30 poziom - 90 dni",  //tekst do wyświetlenia
	'desc' => "lista poziomów"
	),
		2 => Array(
			'command' => "!vip",
			'message' => "[b]Aby kupić rangę lub kanał VIP, udaj się na [url=http://xtrust.pl]xtrust.pl[/url][/b]",
			'desc' => "informacje o VIP"
		),
	),
	'datazero' => '1970-01-01 00:00:00',  //datazero
	'datazeroadmin' => '1970-01-01 00:00:00'  //datazero admin
);

////////////////////////////////////////////
/////////////fourth INSTANCE/////////////////
////////////////////////////////////////////
$config[4]['enable'] = true;

$config[4]['server']['ip'] = '127.0.0.1'; //ip serwera
$config[4]['server']['port'] = 9987; //port serwera
$config[4]['server']['queryport'] = 10011; //port server query
$config[4]['query']['login'] = 'serveradmin'; //nazwa server query
$config[4]['query']['password'] = ''; //hasło server query
$config[4]['bot']['name'] = "#4"; //nazwa bota
$config[4]['bot']['channel'] =  28; //domyślny kanał bota
$config[4]['bot']['speed'] = 5; //intertwał bota
$config[4]['database']['host'] ='127.0.0.1';  //adres bazy danych
$config[4]['database']['login'] = 'phpmyadmin';  //login bazy danych
$config[4]['database']['password'] = '';  //hasło bazy danych
$config[4]['database']['dbname'] = 'xTrustbot';  //nazwa bazy danych
$config[4]['bot']['idletime'] = 5;  //czas nieaktywności, po którym zostanie liczony
$config[4]['bot']['admins_group'] = Array(30,6);  //id grup administracyjnych
$config[4]['bot']['channel_admin_group'] = 5;  //id grupy administracyjnej kanału



$config[4]['functions'] = Array('top_active_time_all', 'top_active_time_month', 'top_active_time_week', 'top_time_all', 'top_time_month', 'top_time_week', 'top_idle_time_all', 'top_idle_time_month', 'top_idle_time_week', 'top_connections', 'new_users', 'top_lvl', 'rank');

		// Top time all //
//Funkcja wyświetla osoby z największym łącznym czasem przebywania na serwerze w opisie kanału
$config['function']['top_time_all'] = Array(
	'enable' => false,
	'channel' => 992, //id kanału
	'count' => 10,  //ilość osób do wyświetlenia
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 5, 'seconds' => 0), //interval
	'datazero' => '1970-01-01 00:00:00'
);

		// Top time month //
//Funkcja wyświetla osoby z największym miesięcznym czasem przebywania na serwerze w opisie kanału
$config['function']['top_time_month'] = Array(
	'enable' => false,
	'channel' => 992, //id kanału
	'count' => 10,  //ilość osób do wyświetlenia
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 5, 'seconds' => 0), //interval
	'datazero' => '1970-01-01 00:00:00'
);

		// Top time week //
//Funkcja wyświetla osoby z największym tygodniowym czasem przebywania na serwerze w opisie kanału
$config['function']['top_time_week'] = Array(
	'enable' => false,
	'channel' => 992, //id kanału
	'count' => 10,  //ilość osób do wyświetlenia
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 5, 'seconds' => 0), //interval
	'datazero' => '1970-01-01 00:00:00'
);


		// Top active time all //
//Funkcja wyświetla osoby z największym czasem łącznej aktywności w opisie kanału
$config['function']['top_active_time_all'] = Array(
	'enable' => false,
	'channel' => 1058, //id kanału
	'count' => 10,  //ilość osób do wyświetlenia
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 5, 'seconds' => 0), //interval
	'datazero' => '1970-01-01 00:00:00'
);

		// Top active time month //
//Funkcja wyświetla osoby z największym czasem miesięcznej aktywności w opisie kanału
$config['function']['top_active_time_month'] = Array(
	'enable' => false,
	'channel' => 992, //id kanału
	'count' => 10,  //ilość osób do wyświetlenia
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 5, 'seconds' => 0), //interval
	'datazero' => '1970-01-01 00:00:00'
);

		// Top active time week //
//Funkcja wyświetla osoby z największym czasem tygodniowej aktywności w opisie kanału
$config['function']['top_active_time_week'] = Array(
	'enable' => true,
	'channel' => 83706, //id kanału
	'count' => 10,  //ilość osób do wyświetlenia
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 5, 'seconds' => 0), //interval
	'datazero' => '1970-01-01 00:00:00'
);

		// Top idle time all //
//Funkcja wyświetla osoby z największym łącznym czasem nieaktywności w opisie kanału
$config['function']['top_idle_time_all'] = Array(
	'enable' => false,
	'channel' => 992, //id kanału
	'count' => 10,  //ilość osób do wyświetlenia
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 5, 'seconds' => 0), //interval
	'datazero' => '1970-01-01 00:00:00'
);

		// Top idle time month //
//Funkcja wyświetla osoby z największym miesięcznym czasem nieaktywności w opisie kanału
$config['function']['top_idle_time_month'] = Array(
	'enable' => false,
	'channel' => 992, //id kanału
	'count' => 10,  //ilość osób do wyświetlenia
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 5, 'seconds' => 0), //interval
	'datazero' => '1970-01-01 00:00:00'
);

		// Top idle time week //
//Funkcja wyświetla osoby z największym tygodniowym czasem nieaktywności w opisie kanału
$config['function']['top_idle_time_week'] = Array(
	'enable' => false,
	'channel' => 992, //id kanału
	'count' => 10,  //ilość osób do wyświetlenia
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 5, 'seconds' => 0), //interval
	'datazero' => '1970-01-01 00:00:00'
);

		// Top connections //
//Funkcja wyświetla osoby z największą ilością połączeń z serwerem w opisie kanału
$config['function']['top_connections'] = Array(
	'enable' => true,
	'channel' => 83707, //id kanału
	'count' => 10,  //ilość osób do wyświetlenia
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 5, 'seconds' => 0), //interval
	'datazero' => '1970-01-01 00:00:00'
);

		// New users //
//Funkcja wyświetla nowych użytkowników w opisie kanału
$config['function']['new_users'] = Array(
	'enable' => true,
	'channel' => 83682, //id kanału
	'count' => 10,  //ilość osób do wyświetlenia
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 10, 'seconds' => 0), //interval
	'datazero' => '1970-01-01 00:00:00'
);

		// Top lvl //
//Funkcja wyświetla osoby z największym poziomem w opisie kanału
$config['function']['top_lvl'] = Array(
	'enable' => false,
	'channel' => 1058, //id kanału
	'icon' => true, //ikony w opisie, jeśli generowanie ikon jest włączone
	'count' => 10,  //ilość osób do wyświetlenia
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 10), //interval
	'datazero' => '1970-01-01 00:00:00'
);

		// Rank //
//Fukcja nadaje rangi na czas przebyty na serwerze
$config['function']['rank'] = Array(
	'enable' => false,
	'type' => 1, // 1 - czas aktywny, 2 - czas łącznie
	'needrank' => Array(14,15),  //wymagane rangi
		'info' => Array(  //rangi
			1 => Array(52,3600),  
			2 => Array(53,7200),
			3 => Array(54,14400),
			4 => Array(55,28800),
			5 => Array(56,43200),
			6 => Array(57,64800),
			7 => Array(58,86400),
			8 => Array(59,172800),
			9 => Array(60,259200),
			10 => Array(61,432000),
			11 => Array(62,604800),
			12 => Array(63,777600),
			13 => Array(64,950400),
			14 => Array(65,1123200),
			15 => Array(66,1296000),
			16 => Array(67,1555200),
			17 => Array(68,1814400),
			18 => Array(69,2073600),
			19 => Array(70,2332800),
			20 => Array(71,2592000),
			21 => Array(72,2851200),
			22 => Array(73,3110400),
			23 => Array(74,3369600),
			24 => Array(75,3628800),
			25 => Array(76,3888000),
			26 => Array(77,4320000),
			27 => Array(78,4752000),
			28 => Array(79,5184000),
			29 => Array(80,6480000),
			30 => Array(81,7776000),
		),
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 20), //interval
	'datazero' => '1970-01-01 00:00:00'
);




////////////////////////////////////////////
/////////////fifth INSTANCE/////////////////
////////////////////////////////////////////
//Instancja jest odpowiedzialna za komendy administracyjne 
$config[5]['enable'] = true;

$config[5]['server']['ip'] = '127.0.0.1'; //ip serwera
$config[5]['server']['port'] = 9987; //port serwera
$config[5]['server']['queryport'] = 10011; //port server query
$config[5]['query']['login'] = 'serveradmin'; //nazwa server query
$config[5]['query']['password'] = ''; //hasło server query
$config[5]['bot']['name'] = "#5"; //nazwa bota
$config[5]['bot']['channel'] =  19; //domyślny kanał bota
$config[5]['database']['host'] ='127.0.0.1';  //adres bazy danych
$config[5]['database']['login'] = 'phpmyadmin';  //login bazy danych
$config[5]['database']['password'] = '';  //hasło bazy danych
$config[5]['database']['dbname'] = 'xTrustbot';  //nazwa bazy danych
$config[5]['bot']['admins_bot'] = Array(30,6);  //id grup administratorów bota
$config[5]['bot']['admins_group'] = Array(30,6);  //id grup administracyjnych




////////////////////////////////////////////
/////////////sixth INSTANCE/////////////////
////////////////////////////////////////////

$config[6]['enable'] = true;

$config[6]['server']['ip'] = '127.0.0.1'; //ip serwera
$config[6]['server']['port'] = 9987; //port serwera
$config[6]['server']['queryport'] = 10011; //port server query
$config[6]['query']['login'] = 'serveradmin'; //nazwa server query
$config[6]['query']['password'] = ''; //hasło server query
$config[6]['bot']['name'] = "#6"; //nazwa bota
$config[6]['bot']['channel'] =  992; //domyślny kanał bota
$config[6]['bot']['speed'] = 1; //intertwał bota

$config[6]['functions'] = Array('karaoke');

		// Karaoke //
$config['function']['karaoke'] = Array(
	'enable' => true,
	'interval' => Array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 10), //interval
	'datazero' => '1970-01-01 00:00:00'
);
?>