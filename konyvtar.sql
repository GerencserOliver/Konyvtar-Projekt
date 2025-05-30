-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2025. Máj 30. 20:41
-- Kiszolgáló verziója: 10.4.28-MariaDB
-- PHP verzió: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `konyvtar`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalok`
--

CREATE TABLE `felhasznalok` (
  `id` int(11) NOT NULL,
  `nev` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `jelszo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `felhasznalok`
--

INSERT INTO `felhasznalok` (`id`, `nev`, `email`, `jelszo`) VALUES
(1, 'oliver', 'oliver@gmail.com', '$2y$10$ej8UTJv/fGg.zNtkMLgf4OSZYFW0bvTwGSDdMj4kmNJD.UsSDnV8O');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kolcsonzesek`
--

CREATE TABLE `kolcsonzesek` (
  `id` int(11) NOT NULL,
  `konyv_id` int(11) NOT NULL,
  `kolcsonzo_nev` varchar(255) NOT NULL,
  `datum` datetime NOT NULL,
  `visszahozva` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `kolcsonzesek`
--

INSERT INTO `kolcsonzesek` (`id`, `konyv_id`, `kolcsonzo_nev`, `datum`, `visszahozva`) VALUES
(13, 17, 'Teszt Olvasó', '2025-05-19 19:41:19', 1),
(14, 18, 'Teszt Olvasó', '2025-05-19 19:40:41', 1),
(15, 19, 'Olivér', '2025-05-19 19:43:10', 0),
(16, 14, 'Olivér', '2025-05-19 19:49:00', 1),
(17, 14, 'dsa', '2025-05-19 19:52:05', 1),
(18, 14, 'dsa', '2025-05-19 19:53:52', 1),
(19, 14, 'dsa', '2025-05-19 19:54:12', 1),
(20, 17, 'dsa', '2025-05-30 20:29:50', 1),
(21, 23, 'dsa', '2025-05-30 20:31:17', 1),
(22, 23, 'dsa', '2025-05-30 20:35:11', 0),
(23, 24, 'dsa', '2025-05-30 20:35:27', 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `konyvek`
--

CREATE TABLE `konyvek` (
  `id` int(11) NOT NULL,
  `cim` varchar(255) NOT NULL,
  `szerzo` varchar(255) NOT NULL,
  `ev` int(11) NOT NULL,
  `isbn` varchar(20) NOT NULL,
  `leiras` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `konyvek`
--

INSERT INTO `konyvek` (`id`, `cim`, `szerzo`, `ev`, `isbn`, `leiras`) VALUES
(14, 'A Pál utcai fiúk', 'Molnár Ferenc', 1907, '9789633897289', 'Klasszikus ifjúsági regény.'),
(15, 'Egri csillagok', 'Gárdonyi Géza', 1899, '9789633897296', 'Török idők, hősies várvédelem.'),
(16, 'Tüskevár', 'Fekete István', 1957, '9789633897302', 'Két fiú nyári kalandjai a Kis-Balatonon.'),
(17, 'A kőszívű ember fiai', 'Jókai Mór', 1869, '9789633897319', 'Szabadságharc, családi dráma.'),
(18, 'Az arany ember', 'Jókai Mór', 1872, '9789633897326', 'Kaland, szerelem, titkok a Dunán.'),
(24, 'dsa', 'dsa', 2313, '3232', '32');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `felhasznalok`
--
ALTER TABLE `felhasznalok`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `kolcsonzesek`
--
ALTER TABLE `kolcsonzesek`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `konyvek`
--
ALTER TABLE `konyvek`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `felhasznalok`
--
ALTER TABLE `felhasznalok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT a táblához `kolcsonzesek`
--
ALTER TABLE `kolcsonzesek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT a táblához `konyvek`
--
ALTER TABLE `konyvek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
