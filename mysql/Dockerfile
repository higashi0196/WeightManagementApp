FROM --platform=linux/amd64 mysql:5.7

ADD ./my.cnf /etc/mysql/conf.d/my.cnf

RUN apt-get update
RUN apt-get -y install locales-all
ENV LANG ja_JP.UTF-8
ENV LANGUAGE ja_JP:ja
ENV LC_ALL ja_JP.UTF-8

RUN chmod 644 /etc/mysql/my.cnf