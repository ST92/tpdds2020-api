# tpdds2020-api

#Consideraciones:
Sobre UniqueEntity Constraint sobre la entidad Competencia del campo nombre. 
    This constraint doesn’t provide any protection against race conditions. 
    They may occur when another entity is persisted by an external process after this validation has passed and before this entity 
    is actually persisted in the database.