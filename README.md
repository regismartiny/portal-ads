# portalADS
Portal do curso de ADS do IFRS Campus Feliz



# Convenção de commits

Deve ser utilizado o seguinte padrão para commits: 
 
tipo(contexto): mensagem
 
Onde: 
  tipo: 
    feat: uma nova feature. 
    fix: uma correção. 
    docs: alteração apenas em documentação. 
    style: alterações que não afetam código (espaço em branco, formatação, etc). 
    refactor: melhoria específica de código, que não tem como motivo correção ou adicionar nada. 
    perf: melhorias de performance 
    test: correção ou adição de testes. 
    chore: alterações diversar envolvendo libs, sdks, etc.
    
  context: em qual parte do software foi aplicado a alteração (ex: login, account, invoices, checkout). Caso não se aplique, pode utilizar *. 
  
  message: uma mensagem rápida sobre o que foi realizado. 
 
 
Exemplo de commit: 
fix(cadUsuario): corrigindo erro quando email é nulo 
