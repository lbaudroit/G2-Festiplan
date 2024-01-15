CREATE TRIGGER add_fest_owner_as_org 
AFTER INSERT 
ON festivals 
FOR EACH ROW
INSERT INTO organise (organise.id_festival, organise.id_login) VALUE (NEW.id_festival, NEW.id_login);

CREATE TRIGGER sup_planif_on_insert
AFTER INSERT 
ON contient 
FOR EACH ROW
DELETE FROM planifie WHERE id_festival=NEW.id_festival;

CREATE TRIGGER sup_planif_on_delete
AFTER DELETE 
ON contient 
FOR EACH ROW
DELETE FROM planifie WHERE id_festival=OLD.id_festival;