CREATE OR REPLACE FUNCTION add_fund_amount(_userid varchar(30),_projectid char(23), _amount integer)
  RETURNS VOID AS
$$
BEGIN
 PERFORM * FROM invest WHERE projectid = _projectid AND investor = _userid;	
 IF(_amount < 0) THEN 
	RETURN;
 ELSIF (_amount = 0) THEN
 	IF (FOUND) THEN 
		DELETE FROM invest WHERE projectid = _projectid AND investor = _userid;
	END IF;
 ELSE
	IF (FOUND) THEN
		UPDATE invest SET amount = _amount WHERE projectid = _projectid AND investor = _userid;
	ELSE 
		INSERT INTO invest VALUES(_userid,_projectid,_amount);
	END IF;
 END IF;
 RETURN;
END;
$$ 
LANGUAGE PLPGSQL;

----------------------------------------------------------------------

DROP TRIGGER IF EXISTS funding_sought_changed ON public.projects;
DROP TRIGGER IF EXISTS invest_updated on public.invest;
DROP TRIGGER IF EXISTS invest_deleted on public.invest;
DROP TRIGGER IF EXISTS invest_inserted on public.invest;

----------------------------------------------------------------------
DROP TRIGGER IF EXISTS funding_sought_changed ON public.projects; 

CREATE OR REPLACE FUNCTION funding_sought_changes()
  RETURNS TRIGGER AS
$$
BEGIN
 IF (NEW.funding_sought < NEW.amount_funded) THEN
	NEW.funding_sought := NEW.amount_funded;
 END IF;
 RETURN NEW;
END;
$$ 
LANGUAGE PLPGSQL;


CREATE TRIGGER funding_sought_changed
  BEFORE UPDATE
  ON projects
  FOR EACH ROW
  EXECUTE PROCEDURE funding_sought_changes();

--------------------------------------
DROP TRIGGER IF EXISTS invest_updated on public.invest;

CREATE OR REPLACE FUNCTION invest_updates()
  RETURNS TRIGGER AS
$$
 DECLARE
	_amount_funded integer;
	_funding_sought integer;	
BEGIN 
 SELECT projects.amount_funded, projects.funding_sought INTO _amount_funded,_funding_sought FROM projects WHERE projects.projectid = NEW.projectid;
 IF (_funding_sought <= _amount_funded - OLD.amount + NEW.amount) THEN
 	NEW.amount := _funding_sought - _amount_funded + OLD.amount;
	IF (OLD.amount = NEW.amount) THEN
		RAISE NOTICE 'This project has already reached its funding goals. Thank you for your support.';
	ELSE
		RAISE NOTICE 'Your funding is more than enough for this project to reach its funding goals. We will set your funding to the amount just enough to reach the goal. Thank you for your support.';
	END IF;	
 END IF;
 UPDATE projects SET amount_funded = amount_funded - OLD.amount + NEW.amount WHERE projectid = NEW.projectid;
 RETURN NEW; 
END;
$$ 
LANGUAGE PLPGSQL;

  
CREATE TRIGGER invest_updated
  BEFORE UPDATE
  ON invest
  FOR EACH ROW
  EXECUTE PROCEDURE invest_updates();
  
  
------------------------------------------------------
DROP TRIGGER IF EXISTS invest_deleted on public.invest;

CREATE OR REPLACE FUNCTION invest_deletes()
  RETURNS TRIGGER AS
$$
BEGIN 
 UPDATE projects 
 SET amount_funded = amount_funded - OLD.amount 
 WHERE projectid = OLD.projectid;
 
 ----UPDATE projects SET projects.amount_funded = projects.amount_funded - OLD.amount  WHERE projects.projectid = OLD.projectid;--------- DOES NOT WORK...
 
 RETURN OLD; 
END;
$$ 
LANGUAGE PLPGSQL;

  
CREATE TRIGGER invest_deleted
  BEFORE DELETE
  ON invest
  FOR EACH ROW
  EXECUTE PROCEDURE invest_deletes();  
  
 
------------------------------------------------------
DROP TRIGGER IF EXISTS invest_inserted on public.invest;

CREATE OR REPLACE FUNCTION invest_inserts()
  RETURNS TRIGGER AS
$$
 DECLARE
	_amount_funded integer;
	_funding_sought integer;
BEGIN 
 SELECT amount_funded, funding_sought INTO _amount_funded,_funding_sought FROM projects WHERE projectid = NEW.projectid;
 IF (_funding_sought <= _amount_funded + NEW.amount) THEN
	NEW.amount := _funding_sought - _amount_funded;
	IF(NEW.amount = 0) THEN
		RAISE NOTICE 'This project has already reached its funding goals. Thank you for your support.';
		RETURN NULL;
	END IF;
	RAISE NOTICE 'Your funding is more than enough for this project to reach its funding goals. We will set your funding to the amount just enough to reach the goal. Thank you for your support.';
 END IF;
 UPDATE projects SET amount_funded = amount_funded + NEW.amount WHERE projectid = NEW.projectid;
 RETURN NEW; 		
END;
$$ 
LANGUAGE PLPGSQL;

  
CREATE TRIGGER invest_inserted
  BEFORE INSERT
  ON invest
  FOR EACH ROW
  EXECUTE PROCEDURE invest_inserts();  