DELIMITER $$
CREATE PROCEDURE sp_deleteTokens()
BEGIN
	delete from personal_access_tokens 
    where created_at < now() - interval 1 day 
    and id > 0;
END $$
DELIMITER ;

CREATE EVENT deleteTokens
ON SCHEDULE EVERY 1 DAY
DO
CALL sp_deleteTokens()