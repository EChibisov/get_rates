- Внешний ресурс возвращает курс по запросу http://external.source/?currency=$currency

- Для возможности получения сразу нескольких значений, имеет место хранить в кэше массив курсов
  А так же передавать в функцию и возвращать из нее массив данных. Из этих соображений в обертку API заложена функция http_build_query().

- Необходимо настроить таймауты в случае длительно ответа от внешнего ресурса, а так же ввести какой-нибудь флаг, на проверку факта получения/обновления курса.
