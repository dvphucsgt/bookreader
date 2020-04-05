FROM centos:7.4.1708

RUN yum clean all && yum -y update
RUN yum -y install epel-release
RUN yum -y install http://rpms.famillecollet.com/enterprise/remi-release-7.rpm
RUN yum -y install httpd mod_ssl php72 php72-php php72-php-mbstring php72-php-mysqlnd php72-php-opcache php72-php-gd php72-php-mcrypt php72-php-xml php72-php-xmlrpc

# apache
RUN sed -i -e "s/var\/www\/html/srv\/public/g" /etc/httpd/conf/httpd.conf
RUN sed -i -e "s/    AllowOverride None/    AllowOverride All/g" /etc/httpd/conf/httpd.conf
RUN echo 'Timeout 600' >> /etc/httpd/conf/httpd.conf


# php
RUN sed -i -e "s/\;date.timezone =/date.timezone = \"Asia\/Tokyo\"/g" /etc/opt/remi/php72/php.ini
RUN sed -i -e "s/\;mbstring.internal_encoding =/mbstring.internal_encoding = \"UTF-8\"/g" /etc/opt/remi/php72/php.ini
RUN sed -i -e "s/\;mbstring.language =/mbstring.language =/g" /etc/opt/remi/php72/php.ini
RUN sed -i -e "s/memory_limit = 128M/memory_limit = 256M/g" /etc/opt/remi/php72/php.ini
RUN sed -i -e "s/post_max_size = 8M/post_max_size = 256M/g" /etc/opt/remi/php72/php.ini
RUN sed -i -e "s/upload_max_filesize = 2M/upload_max_filesize = 256M/g" /etc/opt/remi/php72/php.ini

# Install xdebug.
# Install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === 'baf1608c33254d00611ac1705c1d9958c817a1a33bce370c0595974b342601bd80b92a3f46067da89e3b06bff421f182') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN chmod +x composer-setup.php
RUN php composer-setup.php
#RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer
# zend_extension is configured in /etc/opt/remi/php72/php.d/15-xdebug.ini
RUN yum -y install php72-php-pecl-xdebug \
 && echo $'[xdebug]\n\
; zend_extension=xdebug.so\n\
xdebug.remote_autostart=1\n\
xdebug.remote_enable=1\n\
xdebug.remote_host=docker.for.mac.localhost\n\
xdebug.remote_port=9000' >> /etc/opt/remi/php72/php.ini

# python
RUN yum install -y https://centos7.iuscommunity.org/ius-release.rpm
RUN yum install -y python36u python36u-libs python36u-devel python36u-pip
RUN yum install -y zlib-devel libffi-devel

RUN yum install -y gcc \
gcc-c++ \
postgresql-devel \
lsof \
openssh-clients

RUN pip3.6 install --upgrade pip
RUN pip3.6 install --upgrade setuptools

RUN pip3.6 install mojimoji \
psycopg2 \
sshtunnel \
bottle \
Bottledaemon \
requests \
httpbin \
parse \
sshtunnel

RUN systemctl enable httpd
CMD ["/sbin/init"]