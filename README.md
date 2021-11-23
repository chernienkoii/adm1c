### Server requirement

- OS: Ubuntu 20.04


## Usage

1. Update `adm1c`
    ```
    nano adm1c
    ```
    You should change server_name `adm1c.example.com` to your name  
2. Update `index.php`
    ```
    nano ./source/index.php
    ```
   - You should change DB value from `3b2f6a2e-fe52-41cf-9d29-78984470c4a2` to your id database in cluster.
   - You should change SRV value from `192.168.0.2` to your IP/Hostname server with PROD 1C.
   - You should change CL value from `daca2f07-0606-4034-8128-c1e57e1fc643` to your id Cluster in cluster.
    And another vars in example     
2. Deploy
    ```sh
    docker-compose up -d
    ```
2. Use
    ```sh
    http://adm1c.yourdomainset
    ```    