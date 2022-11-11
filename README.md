# logger-project

Компонент для логирования
- поддерживает разные обработчики (handlers): логирование в файл (FileHandler), логирование в syslog (SysLogHandler), логгер который ничего не делает (FakeHandler).

Результатом выполнение программы должно быть:  
 2 записи в syslog  и 3 следующих файла:  

Файл application.log  
 * *****************  
* 2016-05-30 09:50:57  001  ERROR  Error message  
* 2016-05-30 09:50:57  001  ERROR  Error message  
* 2016-05-30 09:50:57  002  INFO  Info message  
* 2016-05-30 09:50:57  002  INFO  Info message  
* 2016-05-30 09:50:57  003  DEBUG  Debug message  
* 2016-05-30 09:50:57  003  DEBUG  Debug message  
* 2016-05-30 09:50:57  004  NOTICE  Notice message  
* 2016-05-30 09:50:57  004  NOTICE  Notice message  
* 2016-05-30 09:50:57  002  INFO  Info message from FileHandler  
* 2016-05-30 09:50:57  002  INFO  Info message from FileHandler  
* *****************  

Файл application.error.log  
* *****************    
* 2016-05-30 09:50:57  [001]  [ERROR]  Error message  
* 2016-05-30 09:50:57  [001]  [ERROR]  Error message  
* *****************  

Файл application.info.log  
* *****************  
* 2016-05-30 09:50:57  [002]  [INFO]  Info message  
* 2016-05-30 09:50:57  [002]  [INFO]  Info message  
* *****************  

Формат записи в файл:  
{дата} {код уровня логирования} {уровень логирования} {сообщение}  
