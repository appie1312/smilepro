USE breezedemo;

DROP PROCEDURE IF EXISTS sp_get_omzetten;
DELIMITER $$

CREATE PROCEDURE sp_get_omzetten()
BEGIN
    SELECT
        id,
        omschrijving,
        klant_naam,
        datum,
        bedrag
    FROM omzetten
    ORDER BY datum DESC, id DESC;
END $$

DELIMITER ;
