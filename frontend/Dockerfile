FROM node:12

WORKDIR /app

COPY package*.json ./

RUN npm install
RUN npm install axios

# copy project files and folders to the current working directory (i.e. 'app' folder)
COPY . .

# build app for production with minification
RUN npm run build

EXPOSE 3000
CMD ["npm", "run", "serve"]