### 中间件
- 面向切面编程(AOP), 统一拦截请求、权限控制
- demo：记录程序的执行时间中间件
- 注册中间件，分为：全局中间件、路由中间件、控制器构造函数

### 数据库操作
`原生查询、查询构造器、ORM`
- value返回一行中的某个字段
- pluck返回某一列，数据是集合
- get多行是集合，first、find是对象
- where查询构造语句，打印出一条sql, 在后面加->dump()
- updateOrInsert 不存在就写入，存在更新
- 使用ORM，longtext为json, 指定cast指定存、取的时候是array。
- 使用ORM新增数据，create()返回模型对象、受模型约束，insert()返回布尔值没有通过模型。
- 使用ORM新增数据，先创建模型对象，在fill, 在save()。

### 集合的使用
- 

### 使用laravel
- 设计数据库字段时，json存longtext
- 判断集合是否为空，使用isEmpty, 不是empty()
