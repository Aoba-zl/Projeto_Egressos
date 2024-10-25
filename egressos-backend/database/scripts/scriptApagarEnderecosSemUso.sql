DELIMITER $$
CREATE PROCEDURE sp_deleteUnusedAddresses()
BEGIN
	DELETE FROM addresses
	WHERE addresses.id NOT IN(
		SELECT id_address
		FROM companies
	);
END $$
DELIMITER ;

CREATE EVENT deleteUnusedAddresses
ON SCHEDULE EVERY 2 WEEK
DO
CALL sp_deleteUnusedAddresses()