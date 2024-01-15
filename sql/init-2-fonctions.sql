DELIMITER //

CREATE TRIGGER add_fest_owner_as_org 
AFTER INSERT 
ON festivals 
FOR EACH ROW
INSERT INTO organise (organise.id_festival, organise.id_login) VALUE (NEW.id_festival, NEW.id_login);

DELIMITER ;