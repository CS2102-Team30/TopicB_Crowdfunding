WITH table123 AS(
SELECT p.projectid AS projid, SUM(i.amount) AS totalamount FROM projects p, invest i
WHERE p.projectid = i.projectid
GROUP BY p.projectid
)
UPDATE projects SET amount_funded = table123.totalamount FROM table123 WHERE projects.projectid = table123.projid; 