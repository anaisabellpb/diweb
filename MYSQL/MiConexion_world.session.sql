SHOW TABLES;
-- 01. Consulta por campos
-- usamos cláusula LIMIT -> Nº Registros
SELECT Name, CountryCode 
FROM city 
LIMIT 10;

-- 02. Consulta sin registros repstidos
-- Usamos cláusula DISTINCT
SELECT DISTINCT continent 
FROM country;

-- 03. Consulta de tabla completa (*)
SELECT * FROM countrylanguage;

-- 04. Filtrado de registros
-- Uso de WHERE
SELECT * FROM countrylanguage
WHERE CountryCode = "USA";

-- 04b. Filtrado con operadores
-- Uso de WHERE + AND
SELECT * FROM city
WHERE CountryCode = "ESP"
AND Population > 500000;

-- 04c. Filtrado con operadores
-- Uso de WHERE + OR
SELECT * FROM city
WHERE District = "ANDALUSIA"
OR District = "MADRID";

-- 05. Ordenaciones
-- Uso de ORDER BY....ASC (de menor a mayor) / DESC
SELECT * FROM city
WHERE District = "ANDALUSIA"
ORDER BY Population ASC;

-- 06. Ordenaciones con operadores
SELECT * FROM city
WHERE District = "ANDALUSIA"
AND Population > 200000
ORDER BY Population ASC;

-- 07. Conjuntos
-- Uso de la cláusula IN (implica el uso de paréntesis)
SELECT Name, District
FROM city
WHERE Name IN ("Sevilla","Bilbao", "Vigo");

-- 08. Funciones de Agregación:
-- COUNT (contar)
SELECT COUNT(name)
FROM city
WHERE CountryCode = "ESP"
AND Population > 100000;

---Ejercicio: Nº CIudades de FRancia, España y Portugal
SELECT COUNT(NAME)
FROM city
WHERE CountryCode IN ("ESP", "FRA", "PRT");

-- 08b. Funciones de Agregación adicionales:
-- AVG (media), SUM(suma), MAX(máximo), MIN(mínimo)
SELECT AVG(Population)
FROM city
WHERE District = "Andalusia";

-- 09. Agrupación (para sacar más de un dato)
-- Cláusula GROUP BY -> Asociado a funciones de agregación
-- Ejercicio2: DIme la ciudad más grande entre Francia, España y Portugal
SELECT CountryCode, MAX(Population) AS MaxPopulation
FROM city
WHERE CountryCode IN ("ESP", "FRA", "PRT")
GROUP BY CountryCode;

-- 10. Agrupación y filtrado (WHERE para los GROUP BY)
-- wHERE -> HAVING
SELECT CountryCode, COUNT(NAME)
FROM city
GROUP BY CountryCode;


-- 10. Agrupación y filtrado (WHERE para los GROUP BY)
-- wHERE -> HAVING
-- Usamos Alias (este AS hace que podamos cambiar el nombre de la tabla de COUNT a NumCiudades)
SELECT CountryCode, COUNT(NAME) AS NumCiudades
FROM city
GROUP BY CountryCode
HAVING NumCiudades > 100
ORDER BY  NumCiudades DESC
LIMIT 3;

-- 11. JOINS! Unir 2 tablas
SELECT * FROM

-- 12. JOINS! Unir 3 tablas

-- Ejercicio:
-- Sácame distrito, población (de la ciudad), continen,
-- nombre del país, Idioma y porcentaje para ciudades llamadas Córdoba
-- y donde se habla el español (Spanish)
SELECT city.District, city.Population, 
country.Continent, country.Name,
countrylanguage.Language, countrylanguage.Percentage
FROM city, country, countrylanguage
WHERE city.Name = "Córdoba"
AND countrylanguage.Language = "Spanish"
AND city.CountryCode = Country.code
AND Country.code = countrylanguage.CountryCode;



