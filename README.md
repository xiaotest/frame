简单目录结构

_**根目录=>frame**_ 
 
**common =>公共类库文件（config、function、logs、includes）**
 
    1.config : 数据库相关配置文件。
    
    2.function : 公共函数
    
    3.logs :日志文件
    
    4.includes 公共类库包含文件（单独被其他文件引入） 
    
     
**web =>web项目文件（...）**

**library =>第三方类库文件（微信、阿里、威富通等）**

**log =>日志目录**



``****注意每个文件都要引入公共类库包含文件 : includes.php``
     
 