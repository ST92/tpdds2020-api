# tpdds2020-api

#Consideraciones:
Sobre UniqueEntity Constraint sobre la entidad Competencia del campo nombre. 
    This constraint doesn’t provide any protection against race conditions. 
    They may occur when another entity is persisted by an external process after this validation has passed and before this entity 
    is actually persisted in the database.

#Comandos:
#generate entities from db
	php bin/console doctrine:mapping:import "App\Entity" annotation --path=src/Entity

#Generar endpoints
	php bin/console debug:router

#Actualizar BD
	php bin/console doctrine:schema:update --dump-sql
	php bin/console doctrine:schema:update --force

#Verificar consistencia de BD
	
	php bin/console doctrine:schema:validate

#Ejemplo de URL para búsqueda por filtros:
    http://www.atsasantafe.local/api/afiliados?offset=20&limit=20&order_by[id]=ASC&filters[activo]=true&operators[activo]==

#Enlaces usados:
	https://www.doctrine-project.org/projects/doctrine-orm/en/current/reference/association-mapping.html 
	https://jmsyst.com/libs/serializer/master/cookbook/exclusion_strategies
	
#Cosas Pendientes por Hacer:
    Probar CU008
    
    Terminar validaciones de CU009
    
    Terminar validaciones de CU004
    
    Corregir métodos de validaciones Unicas. Aunque creo que no van al final
    
    Implementar los countbygrid si es necesario
       
    Implementar método de CU017.
    
    Probar CU017