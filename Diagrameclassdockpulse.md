```mermaid
classDiagram
    class VM {
        +docker
    }

    class Docker {
        +container 
        +debian()
    }

    class Container {
        +logs : string
        +sendLogs()
    }

    class RSyslog {
        +listenUDP()
        +writeToMySQL()
    }

    class MySQL {
        +logs : table
        +insertLog()
    }

    VM --> Docker
    Docker --> Container
    Container --> RSyslog : send logs
    RSyslog --> MySQL : insert logs
