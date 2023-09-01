.PHONY: ant-server
ant-server:
	docker stop ams
	docker rm ams
	docker volume create antmedia_volume || true
	docker run --name ams -d --net=ant-rest-test_sail -p 5080:5080 -p 1935:1935 -v antmedia_volume:/usr/local/antmedia nibrev/ant-media-server:latest