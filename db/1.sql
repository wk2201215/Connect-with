-- イベントスケジューラを有効にする（一度だけ実行する）
SET GLOBAL event_scheduler = ON;

-- イベントを作成する
CREATE EVENT delete_old_records_event
ON SCHEDULE EVERY 1 DAY
STARTS CURRENT_TIMESTAMP
DO
  DELETE FROM account_tentative
  WHERE delete_at < NOW();