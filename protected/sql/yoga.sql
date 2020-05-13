-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2020. Máj 13. 16:14
-- Kiszolgáló verziója: 10.4.11-MariaDB
-- PHP verzió: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `yoga`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kurzusok`
--

CREATE TABLE `kurzusok` (
  `kurzusid` int(11) NOT NULL,
  `oktatoid` int(11) NOT NULL,
  `csoport` varchar(45) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `kurzusok`
--

INSERT INTO `kurzusok` (`kurzusid`, `oktatoid`, `csoport`) VALUES
(5, 3, 'ASD'),
(6, 3, 'A');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `oktatok`
--

CREATE TABLE `oktatok` (
  `oktatoid` int(11) NOT NULL,
  `nev` varchar(45) COLLATE utf8_hungarian_ci NOT NULL,
  `kepzettseg` varchar(45) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `oktatok`
--

INSERT INTO `oktatok` (`oktatoid`, `nev`, `kepzettseg`) VALUES
(2, 'Sanyi a jó', 'Kezdő'),
(3, 'Szunyi', 'Mester');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `rend`
--

CREATE TABLE `rend` (
  `id` int(11) NOT NULL,
  `kurzusid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `rend`
--

INSERT INTO `rend` (`id`, `kurzusid`) VALUES
(1, 5),
(1, 6);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(45) COLLATE utf8_hungarian_ci NOT NULL,
  `last_name` varchar(45) COLLATE utf8_hungarian_ci NOT NULL,
  `email` varchar(45) COLLATE utf8_hungarian_ci NOT NULL,
  `password` varchar(45) COLLATE utf8_hungarian_ci NOT NULL,
  `permission` varchar(45) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `permission`) VALUES
(1, 'Martin', 'Palotai', 'catsharkshin@gmail.com', '2891baceeef1652ee698294da0e71ba78a2a4064', '2'),
(2, 'Martin', 'Palotai', 'magyarpanda@gmail.com', '2891baceeef1652ee698294da0e71ba78a2a4064', '');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `kurzusok`
--
ALTER TABLE `kurzusok`
  ADD PRIMARY KEY (`kurzusid`),
  ADD KEY `fkIdx_31` (`oktatoid`);

--
-- A tábla indexei `oktatok`
--
ALTER TABLE `oktatok`
  ADD PRIMARY KEY (`oktatoid`);

--
-- A tábla indexei `rend`
--
ALTER TABLE `rend`
  ADD PRIMARY KEY (`id`,`kurzusid`),
  ADD KEY `fkIdx_24` (`id`),
  ADD KEY `fkIdx_28` (`kurzusid`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `kurzusok`
--
ALTER TABLE `kurzusok`
  MODIFY `kurzusid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT a táblához `oktatok`
--
ALTER TABLE `oktatok`
  MODIFY `oktatoid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `kurzusok`
--
ALTER TABLE `kurzusok`
  ADD CONSTRAINT `FK_31` FOREIGN KEY (`oktatoid`) REFERENCES `oktatok` (`oktatoid`);

--
-- Megkötések a táblához `rend`
--
ALTER TABLE `rend`
  ADD CONSTRAINT `FK_24` FOREIGN KEY (`id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_28` FOREIGN KEY (`kurzusid`) REFERENCES `kurzusok` (`kurzusid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
